<?php
/**
 * ServerTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Server;

use pithyone\wechat\Server\Server;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class ServerTest.
 */
class ServerTest extends AbstractTestCase
{
    public function testReply()
    {
        $agent = $this->config['test'];

        $_GET = [
            'msg_signature' => '5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3',
            'timestamp'     => '1409659589',
            'nonce'         => '263014780',
            'echostr'       => 'P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==',
        ];

        $server = new Server($this->config['corp_id'], $agent['token'], $agent['aes_key']);

        $this->assertEquals('1616140317555161061', $server->reply());

        $_GET = [
            'msg_signature' => '477715d11cdb4164915debcba66cb864d751f3e6',
            'timestamp'     => '1409659813',
            'nonce'         => '1372623149',
        ];

        $message = '<xml><ToUserName><![CDATA[wx5823bf96d3bd56c7]]></ToUserName><Encrypt><![CDATA[RypEvHKD8QQKFhvQ6QleEB4J58tiPdvo+rtK1I9qca6aM/wvqnLSV5zEPeusUiX5L5X/0lWfrf0QADHHhGd3QczcdCUpj911L3vg3W/sYYvuJTs3TUUkSUXxaccAS0qhxchrRYt66wiSpGLYL42aM6A8dTT+6k4aSknmPj48kzJs8qLjvd4Xgpue06DOdnLxAUHzM6+kDZ+HMZfJYuR+LtwGc2hgf5gsijff0ekUNXZiqATP7PF5mZxZ3Izoun1s4zG4LUMnvw2r+KqCKIw+3IQH03v+BCA9nMELNqbSf6tiWSrXJB3LAVGUcallcrw8V2t9EL4EhzJWrQUax5wLVMNS0+rUPA3k22Ncx4XXZS9o0MBH27Bo6BpNelZpS+/uh9KsNlY6bHCmJU9p8g7m3fVKn28H3KDYA5Pl/T8Z1ptDAVe0lXdQ2YoyyH2uyPIGHBZZIs2pDBS8R07+qN+E7Q==]]></Encrypt><AgentID><![CDATA[218]]></AgentID></xml>';
        $server = new Server($this->config['corp_id'], $agent['token'], $agent['aes_key'], $message);

        $this->assertEquals($server->msg_signature, '477715d11cdb4164915debcba66cb864d751f3e6');
        $this->assertEquals($server->timestamp, '1409659813');
        $this->assertEquals($server->nonce, '1372623149');
        $this->assertEmpty($server->echostr);
        $this->assertEquals($server->ToUserName, 'wx5823bf96d3bd56c7');
        $this->assertEquals($server->FromUserName, 'mycreate');
        $this->assertEquals($server->CreateTime, '1409659813');
        $this->assertEquals($server->MsgType, 'text');
        $this->assertEquals($server->Content, 'hello');
        $this->assertEquals($server->MsgId, '4561255354251345929');
        $this->assertEquals($server->AgentID, '218');

        $server->text('this is a test');
        $server->reply();
    }
}
