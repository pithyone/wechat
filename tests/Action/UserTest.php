<?php
/**
 * UserTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\User;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class UserTest.
 */
class UserTest extends AbstractTestCase
{
    public function testCreate()
    {
        $body = '{"errcode":0,"errmsg":"created"}';
        $work = $this->getWork($body);

        $json = '{"userid":"zhangsan","name":"张三","english_name":"jackzhang","mobile":"15913215421","department":[1,2],"order":[10,40],"position":"产品经理","gender":"1","email":"zhangsan@gzdev.com","isleader":1,"enable":1,"avatar_mediaid":"2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0","telephone":"020-123456","extattr":{"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}}';
        $data = json_decode($json, true);
        $res = $work->user->create($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(User::USER_CREATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGet()
    {
        $body = '{"errcode":0,"errmsg":"ok","userid":"zhangsan","name":"李四","department":[1,2],"order":[1,2],"position":"后台工程师","mobile":"15913215421","gender":"1","email":"zhangsan@gzdev.com","isleader":1,"avatar":"http://wx.qlogo.cn/mmopen/ajNVdqHZLLA3WJ6DSZUfiakYe37PKnQhBIeOQBO4czqrnZDS79FH5Wm5m4X69TBicnHFlhiafvDwklOpZeXYQQ2icg/0","telephone":"020-123456","english_name":"jackzhang","extattr":{"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]},"status":1}';
        $work = $this->getWork($body);

        $userId = 'zhangsan';
        $res = $work->user->get($userId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(User::USER_GET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($userId, $res['options']['query']['userid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testUpdate()
    {
        $body = '{"errcode":0,"errmsg":"updated"}';
        $work = $this->getWork($body);

        $json = '{"userid":"zhangsan","name":"李四","department":[1],"order":[10],"position":"后台工程师","mobile":"15913215421","gender":"1","email":"zhangsan@gzdev.com","isleader":0,"enable":1,"avatar_mediaid":"2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0","telephone":"020-123456","english_name":"jackzhang","extattr":{"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}}';
        $data = json_decode($json, true);
        $res = $work->user->update($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(User::USER_UPDATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testDelete()
    {
        $body = '{"errcode":0,"errmsg":"deleted"}';
        $work = $this->getWork($body);

        $userId = 'zhangsan';
        $res = $work->user->delete($userId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(User::USER_DELETE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($userId, $res['options']['query']['userid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testBatchDelete()
    {
        $body = '{"errcode":0,"errmsg":"updated"}';
        $work = $this->getWork($body);

        $json = '["zhangsan","lisi"]';
        $data = json_decode($json, true);
        $res = $work->user->batchDelete($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(User::USER_BATCH_DELETE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals(json_decode('{"useridlist":["zhangsan","lisi"]}', true), $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testSimpleLists()
    {
        $body = '{"errcode":0,"errmsg":"ok","userlist":[{"userid":"zhangsan","name":"李四","department":[1,2]}]}';
        $work = $this->getWork($body);

        $departmentId = 1;
        $fetchChild = 1;
        $res = $work->user->simpleLists($departmentId, $fetchChild);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(User::USER_SIMPLE_LIST, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($departmentId, $res['options']['query']['department_id']);
        $this->assertEquals($fetchChild, $res['options']['query']['fetch_child']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testLists()
    {
        $body = '{"errcode":0,"errmsg":"ok","userlist":[{"userid":"zhangsan","name":"李四","department":[1,2],"order":[1,2],"position":"后台工程师","mobile":"15913215421","gender":"1","email":"zhangsan@gzdev.com","isleader":0,"avatar":"http://wx.qlogo.cn/mmopen/ajNVdqHZLLA3WJ6DSZUfiakYe37PKnQhBIeOQBO4czqrnZDS79FH5Wm5m4X69TBicnHFlhiafvDwklOpZeXYQQ2icg/0","telephone":"020-123456","english_name":"jackzhang","status":1,"extattr":{"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}}]}';
        $work = $this->getWork($body);

        $departmentId = 1;
        $fetchChild = 1;
        $res = $work->user->lists($departmentId, $fetchChild);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(User::USER_LIST, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($departmentId, $res['options']['query']['department_id']);
        $this->assertEquals($fetchChild, $res['options']['query']['fetch_child']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testConvertToOpenId()
    {
        $body = '{"errcode":0,"errmsg":"ok","openid":"oDOGms-6yCnGrRovBj2yHij5JL6E","appid":"wxf874e15f78cc84a7"}';
        $work = $this->getWork($body);

        $userId = 'zhangsan';
        $agentId = 1;
        $res = $work->user->convertToOpenId($userId, $agentId);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(User::USER_TO_OPENID, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals(['userid' => $userId, 'agentid' => $agentId], $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testConvertToUserId()
    {
        $body = '{"errcode":0,"errmsg":"ok","userid":"zhangsan"}';
        $work = $this->getWork($body);

        $openId = 'oDOGms-6yCnGrRovBj2yHij5JL6E';
        $res = $work->user->convertToUserId($openId);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(User::USER_TO_USERID, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals(['openid' => $openId], $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testAuthSuccess()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $userId = 'zhangsan';
        $res = $work->user->authSuccess($userId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(User::USER_AUTH_SUCCESS, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($userId, $res['options']['query']['userid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
