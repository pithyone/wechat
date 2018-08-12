<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use Psr\Http\Message\StreamInterface;
use WeWork\Api\Media;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class MediaTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Media
     */
    protected $media;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->media = new Media();
    }

    /**
     * @return void
     */
    public function testUpload()
    {
        $this->httpClient->shouldReceive('postFile')
            ->once()
            ->with('media/upload', 'foo', ['type' => 'file'])
            ->andReturn(['errcode' => 0]);

        $this->media->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->media->upload('file', 'foo'));
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('getStream')
            ->once()
            ->with('media/get', ['media_id' => 'foo'])
            ->andReturn(\Mockery::mock(StreamInterface::class));

        $this->media->setHttpClient($this->httpClient);

        $this->assertInstanceOf(StreamInterface::class, $this->media->get('foo'));
    }

    /**
     * @return void
     */
    public function testGetVoice()
    {
        $this->httpClient->shouldReceive('getStream')
            ->once()
            ->with('media/get/jssdk', ['media_id' => 'foo'])
            ->andReturn(\Mockery::mock(StreamInterface::class));

        $this->media->setHttpClient($this->httpClient);

        $this->assertInstanceOf(StreamInterface::class, $this->media->getVoice('foo'));
    }

    /**
     * @return void
     */
    public function testUploadImg()
    {
        $this->httpClient->shouldReceive('postFile')
            ->once()
            ->with('media/uploadimg', 'foo')
            ->andReturn(['errcode' => 0]);

        $this->media->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->media->uploadImg('foo'));
    }
}
