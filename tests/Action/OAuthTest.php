<?php
/**
 * OAuthTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\OAuth;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class OAuthTest.
 */
class OAuthTest extends AbstractTestCase
{
    public function testGetUserInfo()
    {
        $body = '{"errcode":0,"errmsg":"ok","UserId":"USERID","DeviceId":"DEVICEID","user_ticket":"USER_TICKET","expires_in":7200}';
        $work = $this->getWork($body);

        $code = 'Dul-Y6BjgQBxByMBmXfi7pjbGMyCqjkXtjkJicSRkuc';
        $res = $work->OAuth->getUserInfo($code);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(OAuth::GET_USER_INFO, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($code, $res['options']['query']['code']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGetUserDetail()
    {
        $body = '{"errcode":0,"errmsg":"","userid":"lisi","name":"李四","department":[3],"position":"后台工程师","mobile":"15050495892","gender":1,"email":"xxx@xx.com","avatar":"http://shp.qpic.cn/bizmp/xxxxxxxxxxx/0"}';
        $work = $this->getWork($body);

        $userTicket = 'USER_TICKET';
        $res = $work->OAuth->getUserDetail($userTicket);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(OAuth::GET_USER_DETAIL, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals(['user_ticket' => $userTicket], $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
