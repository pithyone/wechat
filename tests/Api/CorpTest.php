<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Corp;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class CorpTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Corp
     */
    protected $corp;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->corp = new Corp();
    }

    /**
     * @return void
     */
    public function testGetApprovalData()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('corp/getapprovaldata', ['starttime' => 0, 'endtime' => 1])
            ->andReturn(['errcode' => 0]);

        $this->corp->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->corp->getApprovalData(0, 1));
    }

    /**
     * @return void
     */
    public function testGetApprovalDataWithNextSPNum()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('corp/getapprovaldata', ['starttime' => 0, 'endtime' => 1, 'next_spnum' => 2])
            ->andReturn(['errcode' => 0]);

        $this->corp->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->corp->getApprovalData(0, 1, 2));
    }
}
