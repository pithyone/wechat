<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Agent;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class AgentTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Agent
     */
    protected $agent;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->agent = new Agent();

        $this->agent->setAgentId('AGENTID');
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('agent/get', ['agentid' => 'AGENTID'])
            ->andReturn(['errcode' => 0]);

        $this->agent->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->agent->get());
    }

    /**
     * @return void
     */
    public function testSet()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('agent/set', ['agentid' => 'AGENTID', 'foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->agent->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->agent->set(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testList()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('agent/list')
            ->andReturn(['errcode' => 0]);

        $this->agent->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->agent->list());
    }
}
