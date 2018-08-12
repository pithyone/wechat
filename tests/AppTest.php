<?php

namespace WeWork\Tests;

use WeWork\App;

class AppTest extends TestCase
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->app = new App(['corp_id' => 'corpid', 'secret' => 'secret']);
    }

    /**
     * @param $expected
     * @param $id
     * @throws \Exception
     *
     * @dataProvider getProvider
     */
    public function testGet($expected, $id)
    {
        $this->assertInstanceOf($expected, $this->app->get($id));
    }

    /**
     * @return array
     */
    public function getProvider()
    {
        return [
            [\WeWork\ApiCache\Token::class, 'token'],
            [\WeWork\Callback::class, 'callback'],
            [\WeWork\Api\Agent::class, 'agent'],
            [\WeWork\Api\AppChat::class, 'appChat'],
            [\WeWork\Api\Batch::class, 'batch'],
            [\WeWork\Api\CheckIn::class, 'checkIn'],
            [\WeWork\Api\Corp::class, 'corp'],
            [\WeWork\Api\CRM::class, 'crm'],
            [\WeWork\Api\Department::class, 'department'],
            [\WeWork\Api\Invoice::class, 'invoice'],
            [\WeWork\Api\Media::class, 'media'],
            [\WeWork\Api\Menu::class, 'menu'],
            [\WeWork\Api\Message::class, 'message'],
            [\WeWork\Api\Tag::class, 'tag'],
            [\WeWork\Api\User::class, 'user'],
            [\WeWork\ApiCache\JsApiTicket::class, 'jsApiTicket'],
            [\WeWork\ApiCache\Ticket::class, 'ticket'],
            [\WeWork\JSSdk::class, 'jssdk'],
        ];
    }
}
