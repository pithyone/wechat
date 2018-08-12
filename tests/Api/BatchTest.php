<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Batch;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class BatchTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Batch
     */
    protected $batch;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->batch = new Batch();
    }

    /**
     * @return void
     */
    public function testInvite()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('batch/invite', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->batch->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->batch->invite(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testSyncUser()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('batch/syncuser', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->batch->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->batch->syncUser(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testReplaceUser()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('batch/replaceuser', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->batch->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->batch->replaceUser(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testReplaceParty()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('batch/replaceparty', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->batch->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->batch->replaceParty(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testGetResult()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('batch/getresult', ['jobid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->batch->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->batch->getResult('foo'));
    }
}
