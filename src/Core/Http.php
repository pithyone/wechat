<?php

namespace pithyone\wechat\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response as Psr7Response;
use pithyone\wechat\Exceptions\HttpException;
use Psr\Http\Message\ResponseInterface;

class Http
{
    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var array
     */
    protected $query = [];

    const MAX_RETRIES = 3;

    /**
     * Http constructor.
     */
    public function __construct()
    {
        array_push($this->middlewares,
            Middleware::log(Log::getLogger(), new MessageFormatter(MessageFormatter::DEBUG)),
            Middleware::retry($this->decider())
        );
    }

    /**
     * @param string $url
     * @param array  $query
     *
     * @return mixed|ResponseInterface
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get($url, array $query = [])
    {
        $this->addQuery($query);

        return $this->request($url, 'GET');
    }

    /**
     * @param string $url
     * @param array  $json
     *
     * @return mixed|ResponseInterface
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function json($url, array $json = [])
    {
        return $this->request($url, 'POST', ['json' => $json]);
    }

    /**
     * @param string $url
     * @param array  $multipart
     *
     * @return mixed|ResponseInterface
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function upload($url, array $multipart)
    {
        $options = [];
        foreach ($multipart as $name => $path) {
            $options['multipart'][] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        return $this->request($url, 'POST', $options);
    }

    /**
     * @param string $method
     * @param array  $param_arr
     *
     * @throws HttpException
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function response($method, $param_arr = [])
    {
        $method = strtolower($method);
        $body = call_user_func_array([$this, $method], $param_arr);

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
     * @param string $url
     * @param string $method
     * @param array  $options
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function request($url, $method = 'GET', $options = [])
    {
        $client = new Client([
            'base_uri' => 'https://qyapi.weixin.qq.com',
            'timeout'  => 5.0,
        ]);

        $method = strtoupper($method);
        $options['handler'] = $this->getHandler();
        $options['query'] = $this->getQuery();
        $response = $client->request($method, $url, $options);

        return $response;
    }

    /**
     * @return HandlerStack
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    protected function getHandler()
    {
        $stack = HandlerStack::create();

        foreach ($this->middlewares as $middleware) {
            $stack->push($middleware);
        }

        return $stack;
    }

    /**
     * @return \Closure
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    private function decider()
    {
        return function (
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

            Log::warning(sprintf(
                'Retrying %s %s %s/%s, %s',
                $request->getMethod(),
                $request->getUri(),
                $retries + 1,
                self::MAX_RETRIES,
                $response ? 'status code: '.$response->getStatusCode() : $exception->getMessage()
            ), [$request->getHeader('Host')[0]]);

            return true;
        };
    }

    /**
     * @param Psr7Response|null $response
     *
     * @return bool
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    private function isServerError(Psr7Response $response = null)
    {
        return $response && $response->getStatusCode() >= 500;
    }

    /**
     * @param RequestException|null $exception
     *
     * @return bool
     *
     * @author wangbing <pithyone@vip.qq.com>
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
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }
}
