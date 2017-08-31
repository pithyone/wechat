<?php
/**
 * AbstractTestCase.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\tests;

use Doctrine\Common\Cache\FilesystemCache;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use pithyone\wechat\Work;

/**
 * Class AbstractTestCase.
 *
 * 定义测试流程：
 * 1. 请求方式
 * 2. 请求地址
 * 3. GET 参数
 * 4. POST 参数
 * 5. 返回结果
 */
abstract class AbstractTestCase extends TestCase
{
    const ACCESS_TOKEN = 'accesstoken000001';

    protected $config = [
        'corp_id' => 'wx5823bf96d3bd56c7',
        'test'    => [
            'agent_id' => 'your-test-agent-id',
            'token'    => 'QDG6eK',
            'aes_key'  => 'jWmYm7qr5nMoAUwZRjGtBxmz3KA1tkAj3ykkR6q2B2C',
            'secret'   => 'your-test-agent-secret',
        ],
    ];

    protected function getWork($body)
    {
        $http = \Mockery::mock('pithyone\wechat\Util\Http[request,getFileContents]');

        $http->shouldReceive('request')->andReturnUsing(function (
            $uri,
            $method = 'GET',
            $options = []
        ) use ($http, $body) {
            $options = array_merge($options, ['query' => $http->getQuery()]);

            return new Response(
                200,
                ['Content-Type' => 'application/json; charset=UTF-8'],
                json_encode(array_merge(
                    json_decode($body, true),
                    ['uri' => $uri, 'method' => $method, 'options' => $options]
                ))
            );
        });

        $http->shouldReceive('getFileContents')->andReturn('abc');

        $this->config['http'] = $http;

        $token = \Mockery::mock('pithyone\wechat\Action\Token[get]',
            ['', '', '', $http, new FilesystemCache(sys_get_temp_dir())]);
        $token->shouldReceive('get')->andReturn(self::ACCESS_TOKEN);
        $this->config['token'] = $token;

        $work = new Work($this->config);

        return $work->setAgentId('test');
    }
}
