<?php

namespace WeWork\Tests\ApiCache;

use WeWork\ApiCache\Token;
use WeWork\Http\HttpClientInterface;
use WeWork\Tests\TestCase;

class TokenTest extends TestCase
{
    /**
     * @var Token
     */
    protected $token;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->token = new Token();

        $this->token->setSecret('foo');
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetCacheKey()
    {
        $this->assertEquals('75e021ba614c0848bf2fbac06afec8ca', $this->callMethod($this->token, 'getCacheKey'));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function testGetFromServer()
    {
        $this->token->setCorpId('bar');

        $httpClient = \Mockery::mock(HttpClientInterface::class);

        $httpClient->shouldReceive('get')
            ->once()
            ->with('gettoken', ['corpid' => 'bar', 'corpsecret' => 'foo'])
            ->andReturn(['access_token' => 'baz']);

        $this->token->setHttpClient($httpClient);

        $this->assertEquals('baz', $this->callMethod($this->token, 'getFromServer'));
    }
}
