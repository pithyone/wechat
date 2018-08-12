<?php

namespace WeWork\Tests\Http;

use WeWork\Http\Response;
use WeWork\Tests\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testToArray()
    {
        $response = \Mockery::mock(Response::class . '[getBody]');

        $response->shouldReceive('getBody')
            ->once()
            ->withNoArgs()
            ->andReturn('{"errcode":0,"errmsg":"foo"}');

        $this->assertEquals(['errcode' => 0, 'errmsg' => 'foo'], $response->toArray());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testToArrayException()
    {
        $response = \Mockery::mock(Response::class . '[getBody]');

        $response->shouldReceive('getBody')
            ->once()
            ->withNoArgs()
            ->andReturn('');

        $response->toArray();
    }
}
