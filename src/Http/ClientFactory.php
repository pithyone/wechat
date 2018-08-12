<?php

namespace WeWork\Http;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Psr\Log\LoggerInterface;
use WeWork\ApiCache\Token;

class ClientFactory
{
    /**
     * @param LoggerInterface $logger
     * @param Token $token
     * @return Client
     */
    public static function create(LoggerInterface $logger, $token = null)
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::retry($logger));
        $stack->push(Middleware::response());
        $stack->push(Middleware::log($logger));

        if ($token instanceof Token) {
            $stack->push(Middleware::auth($token));
        }

        return new Client([
            'base_uri' => 'https://qyapi.weixin.qq.com/cgi-bin/',
            'handler' => $stack
        ]);
    }
}
