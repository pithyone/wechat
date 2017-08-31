<?php
/**
 * TokenTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class TokenTest.
 */
class TokenTest extends AbstractTestCase
{
    public function testGet()
    {
        $work = $this->getWork('{"errcode":0,"errmsg":"","access_token":"accesstoken000001","expires_in":7200}');
        $this->assertEquals(self::ACCESS_TOKEN, $work->token->get());
        $this->assertEquals(self::ACCESS_TOKEN, $work->token->get(true));
    }
}
