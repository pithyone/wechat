<?php

namespace WeWork\Tests\Http;

use Psr\Log\LoggerInterface;
use WeWork\ApiCache\Token;
use WeWork\Http\Middleware;
use WeWork\Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * @return void
     */
    public function testAuth()
    {
        $this->assertInstanceOf(\Closure::class, Middleware::auth(\Mockery::mock(Token::class)));
    }

    /**
     * @return void
     */
    public function testLog()
    {
        $this->assertInstanceOf(\Closure::class, Middleware::log(\Mockery::mock(LoggerInterface::class)));
    }

    /**
     * @return void
     */
    public function testRetry()
    {
        $this->assertInstanceOf(\Closure::class, Middleware::retry(\Mockery::mock(LoggerInterface::class)));
    }

    /**
     * @return void
     */
    public function testResponse()
    {
        $this->assertInstanceOf(\Closure::class, Middleware::response());
    }
}
