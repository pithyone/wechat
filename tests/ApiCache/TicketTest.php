<?php

namespace WeWork\Tests\ApiCache;

use WeWork\ApiCache\Ticket;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * @var Ticket
     */
    protected $ticket;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->ticket = new Ticket();
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetCacheKey()
    {
        $this->assertEquals('eca7e9ee3d2dc60c8d25d665119b7a3e', $this->callMethod($this->ticket, 'getCacheKey'));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetFromServer()
    {
        $httpClient = \Mockery::mock(HttpClientInterface::class);

        $httpClient->shouldReceive('get')
            ->once()
            ->with('ticket/get', ['type' => 'wx_card'])
            ->andReturn(['ticket' => 'foo']);

        $this->ticket->setHttpClient($httpClient);

        $this->assertEquals('foo', $this->callMethod($this->ticket, 'getFromServer'));
    }
}
