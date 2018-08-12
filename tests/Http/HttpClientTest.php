<?php

namespace WeWork\Tests\Http;

use GuzzleHttp\Client;
use Mockery\MockInterface;
use org\bovigo\vfs\vfsStream;
use Psr\Http\Message\StreamInterface;
use WeWork\Http\HttpClient;
use WeWork\Tests\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $client;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client = \Mockery::mock(Client::class);
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $response = \Mockery::mock();

        $response->shouldReceive('toArray')
            ->once()
            ->withNoArgs()
            ->andReturn(['foo' => 'bar']);

        $this->client->shouldReceive('get')
            ->once()
            ->with('foo', ['query' => ['bar' => 'baz']])
            ->andReturn($response);

        $httpClient = new HttpClient($this->client);

        $this->assertEquals(['foo' => 'bar'], $httpClient->get('foo', ['bar' => 'baz']));
    }

    /**
     * @return void
     */
    public function testGetStream()
    {
        $response = \Mockery::mock();

        $response->shouldReceive('getBody')
            ->once()
            ->withNoArgs()
            ->andReturn(\Mockery::mock(StreamInterface::class));

        $this->client->shouldReceive('get')
            ->once()
            ->with('foo', ['query' => ['bar' => 'baz']])
            ->andReturn($response);

        $httpClient = new HttpClient($this->client);

        $this->assertInstanceOf(StreamInterface::class, $httpClient->getStream('foo', ['bar' => 'baz']));
    }

    /**
     * @return void
     */
    public function testPostJson()
    {
        $response = \Mockery::mock();

        $response->shouldReceive('toArray')
            ->once()
            ->withNoArgs()
            ->andReturn(['foo' => 'bar']);

        $this->client->shouldReceive('post')
            ->once()
            ->with('foo', ['json' => ['bar'], 'query' => ['baz']])
            ->andReturn($response);

        $httpClient = new HttpClient($this->client);

        $this->assertEquals(['foo' => 'bar'], $httpClient->postJson('foo', ['bar'], ['baz']));
    }

    /**
     * @return void
     */
    public function testPostFile()
    {
        $path = vfsStream::setup('root', null, ['foo.png' => 'bar'])->getChild('foo.png')->url();

        $response = \Mockery::mock();

        $response->shouldReceive('toArray')
            ->once()
            ->withNoArgs()
            ->andReturn(['foo' => 'bar']);

        $this->client->shouldReceive('post')
            ->once()
            ->with('foo', \Mockery::on(function ($argument) {
                return $argument['multipart'][0]['name'] === 'media' && is_resource($argument['multipart'][0]['contents']) && $argument['query'] === ['bar' => 'baz'];
            }))
            ->andReturn($response);

        $httpClient = new HttpClient($this->client);

        $this->assertEquals(['foo' => 'bar'], $httpClient->postFile('foo', $path, ['bar' => 'baz']));
    }
}
