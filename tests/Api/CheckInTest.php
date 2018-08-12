<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\CheckIn;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class CheckInTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var CheckIn
     */
    protected $checkIn;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->checkIn = new CheckIn();
    }

    /**
     * @return void
     */
    public function testGetOption()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('checkin/getcheckinoption', ['datetime' => 0, 'useridlist' => ['foo']])
            ->andReturn(['errcode' => 0]);

        $this->checkIn->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->checkIn->getOption(0, ['foo']));
    }

    /**
     * @return void
     */
    public function testGetDataWithCommuteType()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('checkin/getcheckindata', [
                'opencheckindatatype' => 1,
                'starttime' => 0,
                'endtime' => 1,
                'useridlist' => ['foo']
            ])
            ->andReturn(['errcode' => 0]);

        $this->checkIn->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->checkIn->getData(CheckIn::TYPE_COMMUTE, 0, 1, ['foo']));
    }

    /**
     * @return void
     */
    public function testGetDataWithOutsideType()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('checkin/getcheckindata', [
                'opencheckindatatype' => 2,
                'starttime' => 0,
                'endtime' => 1,
                'useridlist' => ['foo']
            ])
            ->andReturn(['errcode' => 0]);

        $this->checkIn->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->checkIn->getData(CheckIn::TYPE_OUTSIDE, 0, 1, ['foo']));
    }

    /**
     * @return void
     */
    public function testGetDataWithAllType()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('checkin/getcheckindata', [
                'opencheckindatatype' => 3,
                'starttime' => 0,
                'endtime' => 1,
                'useridlist' => ['foo']
            ])
            ->andReturn(['errcode' => 0]);

        $this->checkIn->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->checkIn->getData(CheckIn::TYPE_ALL, 0, 1, ['foo']));
    }
}
