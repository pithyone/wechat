<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\CRM;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class CRMTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var CRM
     */
    protected $crm;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->crm = new CRM();
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('crm/get_external_contact', ['external_userid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->crm->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->crm->getExternalContact('foo'));
    }
}
