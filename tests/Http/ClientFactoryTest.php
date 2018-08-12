<?php

namespace WeWork\Tests\Http;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use WeWork\ApiCache\Token;
use WeWork\Http\ClientFactory;
use WeWork\Tests\TestCase;

class ClientFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreate()
    {
        $this->assertInstanceOf(Client::class, ClientFactory::create(\Mockery::mock(LoggerInterface::class)));
    }

    /**
     * @return void
     */
    public function testCreateWithToken()
    {
        $this->assertInstanceOf(Client::class, ClientFactory::create(
            \Mockery::mock(LoggerInterface::class),
            \Mockery::mock(Token::class)
        ));
    }
}
