<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Menu;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->menu = new Menu();

        $this->menu->setAgentId('AGENTID');
    }

    /**
     * @return void
     */
    public function testCreate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('menu/create', ['bar' => 'baz'], ['agentid' => 'AGENTID'])
            ->andReturn(['errcode' => 0]);

        $this->menu->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->menu->create(['bar' => 'baz']));
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('menu/get', ['agentid' => 'AGENTID'])
            ->andReturn(['errcode' => 0]);

        $this->menu->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->menu->get());
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('menu/delete', ['agentid' => 'AGENTID'])
            ->andReturn(['errcode' => 0]);

        $this->menu->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->menu->delete());
    }
}
