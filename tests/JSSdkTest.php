<?php

namespace WeWork\Tests;

use WeWork\ApiCache\JsApiTicket;
use WeWork\ApiCache\Ticket;
use WeWork\JSSdk;

class JSSdkTest extends TestCase
{
    /**
     * @var JSSdk
     */
    private $jssdk;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->jssdk = \Mockery::mock(JSSdk::class . '[getTimestamp,getNonceStr]')
            ->shouldAllowMockingProtectedMethods();

        $this->jssdk->shouldReceive('getTimestamp')
            ->once()
            ->withNoArgs()
            ->andReturn(1234567890);

        $this->jssdk->shouldReceive('getNonceStr')
            ->once()
            ->withNoArgs()
            ->andReturn('noncestr');
    }

    /**
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function testGetConfig()
    {
        $jsApiTicket = \Mockery::mock(JsApiTicket::class);

        $jsApiTicket->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn('jsapi_ticket');

        $this->jssdk->setCorpId('corpid');

        $this->jssdk->setJsApiTicket($jsApiTicket);

        $this->assertEquals([
            'appId' => 'corpid',
            'timestamp' => 1234567890,
            'nonceStr' => 'noncestr',
            'signature' => 'ae51fe229cba1316ed477ecbb06a53631ceaef2f'
        ], $this->jssdk->getConfig('url'));
    }

    /**
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function testGetChooseInvoiceConfig()
    {
        $ticket = \Mockery::mock(Ticket::class);

        $ticket->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn('api_ticket');

        $this->jssdk->setCorpId('corpid');

        $this->jssdk->setTicket($ticket);

        $this->assertEquals([
            'timestamp' => 1234567890,
            'nonceStr' => 'noncestr',
            'cardSign' => 'c1140f85f3fd19bd2f2e5716684086dca782774b'
        ], $this->jssdk->getChooseInvoiceConfig('url'));
    }
}
