<?php

namespace pithyone\wechat\Util;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response as Psr7Response;
use pithyone\wechat\Exception\HttpException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Http.
 */
class Http
{
    const MAX_RETRIES = 3;

    /**
     * @var callable
     */
    private $handler = null;

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var array
     */
    protected $query = [];

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->middlewares ?: array_push($this->middlewares,
            Middleware::log(Logger::getLogger(), new MessageFormatter(MessageFormatter::DEBUG)),
            Middleware::retry(function (
                $retries,
                Psr7Request $request,
                Psr7Response $response = null,
                RequestException $exception = null
            ) {
                if ($retries >= self::MAX_RETRIES) {
                    return false;
                }

                if (!($this->isServerError($response) || $this->isConnectError($exception))) {
                    return false;
                }

                Logger::warning(sprintf(
                    'Retrying %s %s %s/%s, %s',
                    $request->getMethod(),
                    $request->getUri(),
                    $retries + 1,
                    self::MAX_RETRIES,
                    $response ? 'status code: '.$response->getStatusCode() : ($exception ? $exception->getMessage() : '')
                ), [$request->getHeader('Host')[0]]);

                return true;
            })
        );
    }

    /**
     * @param string $uri
     * @param array  $query
     *
     * @return ResponseInterface
     */
    public function get($uri, array $query = [])
    {
        $this->addQuery($query);

        return $this->request($uri, 'GET');
    }

    /**
     * @param string $uri
     * @param array  $json
     *
     * @return ResponseInterface
     */
    public function json($uri, array $json = [])
    {
        return $this->request($uri, 'POST', ['json' => $json]);
    }

    /**
     * @param string $uri
     * @param array  $list
     *
     * @return ResponseInterface
     */
    public function upload($uri, array $list)
    {
        $multipart = [];

        foreach ($list as $name => $path) {
            array_push($multipart, ['name' => $name, 'contents' => $this->getFileContents($path)]);
        }

        return $this->request($uri, 'POST', ['multipart' => $multipart]);
    }

    /**
     * @param string $path
     *
     * @return bool|resource
     */
    public function getFileContents($path)
    {
        return fopen($path, 'r');
    }

    /**
     * @param string $method
     * @param array  $param
     *
     * @throws HttpException
     *
     * @return mixed|\Psr\Http\Message\StreamInterface
     */
    public function response($method, $param = [])
    {
        $body = call_user_func_array([$this, strtolower($method)], $param);

        if ($body instanceof ResponseInterface) {
            $body = $body->getBody();
        }

        try {
            $ret = \GuzzleHttp\json_decode($body, true);

            if (0 !== $ret['errcode']) {
                throw new HttpException($ret['errmsg'], $ret['errcode']);
            }

            return $ret;
        } catch (\InvalidArgumentException $e) {
            return $body;
        }
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function request($uri, $method = 'GET', $options = [])
    {
        $client = new Client([
            'base_uri' => 'https://qyapi.weixin.qq.com',
            'timeout'  => 5.0,
        ]);

        $options = array_merge($options, ['handler' => $this->getHandler(), 'query' => $this->query]);
        $response = $client->request($method, $uri, $options);

        return $response;
    }

    /**
     * @return HandlerStack
     */
    protected function getHandler()
    {
        $stack = HandlerStack::create($this->handler);
        if (!($this->handler instanceof MockHandler)) {
            array_map([$stack, 'push'], $this->middlewares);
        }

        return $stack;
    }

    /**
     * @param Psr7Response|null $response
     *
     * @return bool
     */
    private function isServerError(Psr7Response $response = null)
    {
        return $response && $response->getStatusCode() >= 500;
    }

    /**
     * @param RequestException|null $exception
     *
     * @return bool
     */
    private function isConnectError(RequestException $exception = null)
    {
        return $exception instanceof ConnectException;
    }

    /**
     * @param array $query
     */
    public function addQuery($query)
    {
        $this->query = array_merge($this->query, $query);
    }

    /**
     * @param callable $handler
     */
    public function setHandler(callable $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }
}
