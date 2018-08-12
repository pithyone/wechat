<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\User;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var User
     */
    protected $user;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->user = new User();
    }

    /**
     * @return void
     */
    public function testCreate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/create', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->create(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('user/get', ['userid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->get('foo'));
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/update', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->update(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('user/delete', ['userid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->delete('foo'));
    }

    /**
     * @return void
     */
    public function testBatchDelete()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/batchdelete', ['useridlist' => ['foo', 'bar']])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->batchDelete(['foo', 'bar']));
    }

    /**
     * @param int $departmentId
     * @param bool $fetchChild
     * @param bool $needDetail
     * @param string $uri
     * @param array $query
     * @return void
     *
     * @dataProvider listProvider
     */
    public function testList($departmentId, $fetchChild, $needDetail, $uri, $query)
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with($uri, $query)
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->list($departmentId, $fetchChild, $needDetail));
    }

    /**
     * @return array
     */
    public function listProvider()
    {
        return [
            [1, false, false, 'user/simplelist', ['department_id' => 1, 'fetch_child' => 0]],
            [2, false, true, 'user/list', ['department_id' => 2, 'fetch_child' => 0]],
            [3, true, false, 'user/simplelist', ['department_id' => 3, 'fetch_child' => 1]],
            [4, true, true, 'user/list', ['department_id' => 4, 'fetch_child' => 1]]
        ];
    }

    /**
     * @return void
     */
    public function testConvertIdToOpenid()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/convert_to_openid', ['userid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->convertIdToOpenid('foo'));
    }

    /**
     * @return void
     */
    public function testConvertOpenidToUserId()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/convert_to_userid', ['openid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->convertOpenidToUserId('foo'));
    }

    /**
     * @return void
     */
    public function testAuthSuccess()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('user/authsucc', ['userid' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->authSuccess('foo'));
    }

    /**
     * @return void
     */
    public function testGetInfo()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('user/getuserinfo', ['code' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->getInfo('foo'));
    }

    /**
     * @return void
     */
    public function testGetDetail()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('user/getuserdetail', ['user_ticket' => 'foo'])
            ->andReturn(['errcode' => 0]);

        $this->user->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->user->getDetail('foo'));
    }
}
