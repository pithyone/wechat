<?php
/**
 * MenuTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Menu;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class MenuTest.
 */
class MenuTest extends AbstractTestCase
{
    public function testCreate()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $json = '{"button":[{"type":"click","name":"今日歌曲","key":"V1001_TODAY_MUSIC"},{"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http://www.soso.com/"},{"type":"click","name":"赞一下我们","key":"V1001_GOOD"}]}]}';
        $data = json_decode($json, true);
        $res = $work->menu->create($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Menu::MENU_CREATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGet()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $res = $work->menu->get();

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Menu::MENU_GET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals('your-test-agent-id', $res['options']['query']['agentid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testDelete()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $res = $work->menu->delete();

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Menu::MENU_DELETE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals('your-test-agent-id', $res['options']['query']['agentid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
