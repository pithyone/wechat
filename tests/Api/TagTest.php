<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Tag;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Tag
     */
    protected $tag;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->tag = new Tag();
    }

    /**
     * @return void
     */
    public function testCreateWithNoId()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('tag/create', ['tagname' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->create('foo'));
    }

    /**
     * @param string $name
     * @param string $id
     * @param array $json
     * @return void
     *
     * @dataProvider createProvider
     */
    public function testCreateWithId($name, $id, $json)
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('tag/create', $json)
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->create($name, $id));
    }

    /**
     * @return array
     */
    public function createProvider()
    {
        return [
            ['foo', 0, ['tagname' => 'foo']],
            ['bar', 1, ['tagname' => 'bar', 'tagid' => 1]]
        ];
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('tag/update', ['tagid' => 1, 'tagname' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->update(1, 'foo'));
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('tag/delete', ['tagid' => 1])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->delete(1));
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('tag/get', ['tagid' => 1])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->get(1));
    }

    /**
     * @return void
     */
    public function testAddUsers()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('tag/addtagusers', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->addUsers(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testDelUsers()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('tag/deltagusers', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->delUsers(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testList()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('tag/list')
            ->andReturn(['errcode' => 0]);

        $this->tag->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->tag->list());
    }
}
