<?php
/**
 * TagTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Tag;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class TagTest.
 */
class TagTest extends AbstractTestCase
{
    public function testCreate()
    {
        $body = '{"errcode":0,"errmsg":"created","tagid":12}';
        $work = $this->getWork($body);

        $json = '{"tagname":"UI","tagid":12}';
        $data = json_decode($json, true);
        $res = $work->tag->create($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Tag::TAG_CREATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testUpdate()
    {
        $body = '{"errcode":0,"errmsg":"updated"}';
        $work = $this->getWork($body);

        $json = '{"tagid":12,"tagname":"UI design"}';
        $data = json_decode($json, true);
        $res = $work->tag->update($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Tag::TAG_UPDATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testDelete()
    {
        $body = '{"errcode":0,"errmsg":"deleted"}';
        $work = $this->getWork($body);

        $tagId = 12;
        $res = $work->tag->delete($tagId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Tag::TAG_DELETE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($tagId, $res['options']['query']['tagid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGet()
    {
        $body = '{"errcode":0,"errmsg":"ok","tagname":"乒乓球协会","userlist":[{"userid":"zhangsan","name":"李四"}],"partylist":[2]}';
        $work = $this->getWork($body);

        $tagId = 12;
        $res = $work->tag->get($tagId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Tag::TAG_GET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($tagId, $res['options']['query']['tagid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testAddUsers()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $json = '{"tagid":12,"userlist":["user1","user2"],"partylist":[4]}';
        $data = json_decode($json, true);
        $res = $work->tag->addUsers($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Tag::TAG_ADD_USER, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testDelUsers()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $json = '{"tagid":12,"userlist":["user1","user2"],"partylist":[4]}';
        $data = json_decode($json, true);
        $res = $work->tag->delUsers($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Tag::TAG_DEL_USER, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testLists()
    {
        $body = '{"errcode":0,"errmsg":"ok","taglist":[{"tagid":1,"tagname":"a"},{"tagid":2,"tagname":"b"}]}';
        $work = $this->getWork($body);

        $res = $work->tag->lists();

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Tag::TAG_LIST, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
