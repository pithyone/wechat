<?php

namespace WeWork\Tests\ApiCache;

use PHPUnit\Framework\MockObject\MockObject;
use Psr\SimpleCache\CacheInterface;
use WeWork\ApiCache\AbstractApiCache;
use WeWork\Tests\TestCase;

class AbstractApiCacheTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $mock;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mock = $this->getMockForAbstractClass(AbstractApiCache::class);

        $this->mock->expects($this->once())
            ->method('getCacheKey')
            ->will($this->returnValue('foo'));
    }

    /**
     * @param bool $refresh
     * @param string $value
     * @param int $limit
     * @param string $expected
     * @return void
     *
     * @dataProvider getProvider
     */
    public function testGet($refresh, $value, $limit, $expected)
    {
        $cache = \Mockery::mock(CacheInterface::class);

        $cache->shouldReceive('get')
            ->once()
            ->with('foo')
            ->andReturn($value);

        $cache->shouldReceive('set')
            ->times($limit)
            ->with('foo', 'bar', 7100)
            ->andReturnSelf();

        $this->mock->setCache($cache);

        $this->mock->expects($this->exactly($limit))
            ->method('getFromServer')
            ->will($this->returnValue('bar'));

        $this->assertEquals($expected, $this->mock->get($refresh));
    }

    /**
     * @return array
     */
    public function getProvider()
    {
        return [
            [true, 'foo', 1, 'bar'],
            [true, '', 1, 'bar'],
            [false, 'foo', 0, 'foo'],
            [false, '', 1, 'bar'],
        ];
    }
}
