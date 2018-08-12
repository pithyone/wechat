<?php

namespace WeWork\Http;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use WeWork\ApiCache\Token;

class Middleware
{
    const RETRY_MAX_RETRIES = 1;

    /**
     * @param Token $token
     * @return callable
     */
    public static function auth(Token $token)
    {
        return \GuzzleHttp\Middleware::mapRequest(function (RequestInterface $request) use ($token) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'access_token', $token->get()));
        });
    }

    /**
     * @param LoggerInterface $logger
     * @return callable
     */
    public static function log(LoggerInterface $logger)
    {
        return \GuzzleHttp\Middleware::log($logger, new MessageFormatter(MessageFormatter::DEBUG), LogLevel::DEBUG);
    }

    /**
     * @param LoggerInterface $logger
     * @return callable
     */
    public static function retry(LoggerInterface $logger)
    {
        return \GuzzleHttp\Middleware::retry(function (
            $retries,
            Request $request,
            Response $response = null,
            RequestException $exception = null
        ) use ($logger) {
            if ($retries >= self::RETRY_MAX_RETRIES) {
                return false;
            }

            if (!(self::isServerError($response) || self::isConnectError($exception))) {
                return false;
            }

            $logger->warning(
                sprintf(
                    'Retrying %s %s %s/%s, %s',
                    $request->getMethod(),
                    $request->getUri(),
                    $retries + 1,
                    self::RETRY_MAX_RETRIES,
                    $response ? 'status code: ' . $response->getStatusCode() : $exception->getMessage()
                ),
                [$request->getHeader('Host')[0]]
            );

            return true;
        });
    }

    /**
     * @return callable
     */
    public static function response()
    {
        return \GuzzleHttp\Middleware::mapResponse(function (ResponseInterface $response) {
            return new Response(
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getBody(),
                $response->getProtocolVersion(),
                $response->getReasonPhrase()
            );
        });
    }

    /**
     * @param Response $response
     *
     * @return bool
     */
    private static function isServerError(Response $response = null)
    {
        return $response && $response->getStatusCode() >= 500;
    }

    /**
     * @param RequestException $exception
     *
     * @return bool
     */
    private static function isConnectError(RequestException $exception = null)
    {
        return $exception instanceof ConnectException;
    }
}
