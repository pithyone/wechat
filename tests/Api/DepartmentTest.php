<?php

namespace WeWork\Tests\Api;

use Mockery\MockInterface;
use WeWork\Api\Department;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $httpClient;

    /**
     * @var Department
     */
    protected $department;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->httpClient = \Mockery::mock(HttpClientInterface::class);

        $this->department = new Department();
    }

    /**
     * @return void
     */
    public function testCreate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('department/create', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->department->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->department->create(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $this->httpClient->shouldReceive('postJson')
            ->once()
            ->with('department/update', ['foo' => 'bar'])
            ->andReturn(['errcode' => 0]);

        $this->department->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->department->update(['foo' => 'bar']));
    }

    /**
     * @return void
     */
    public function testDelete()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('department/delete', ['id' => 1])
            ->andReturn(['errcode' => 0]);

        $this->department->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->department->delete(1));
    }

    /**
     * @return void
     */
    public function testAllList()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('department/list', [])
            ->andReturn(['errcode' => 0]);

        $this->department->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->department->list());
    }

    /**
     * @return void
     */
    public function testList()
    {
        $this->httpClient->shouldReceive('get')
            ->once()
            ->with('department/list', ['id' => 1])
            ->andReturn(['errcode' => 0]);

        $this->department->setHttpClient($this->httpClient);

        $this->assertEquals(['errcode' => 0], $this->department->list(1));
    }
}
