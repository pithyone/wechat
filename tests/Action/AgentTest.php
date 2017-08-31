<?php
/**
 * AgentTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Agent;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class AgentTest.
 */
class AgentTest extends AbstractTestCase
{
    public function testGet()
    {
        $body = '{"errcode":0,"errmsg":"ok","agentid":"1","name":"NAME","square_logo_url":"xxxxxxxx","description":"desc","allow_userinfos":{"user":[{"userid":"id1"},{"userid":"id2"},{"userid":"id3"}]},"allow_partys":{"partyid":[1]},"allow_tags":{"tagid":[1,2,3]},"close":0,"redirect_domain":"www.qq.com","report_location_flag":0,"isreportenter":0,"home_url":"http://www.qq.com"}';
        $work = $this->getWork($body);

        $res = $work->agent->get();

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Agent::AGENT_GET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals('your-test-agent-id', $res['options']['query']['agentid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testSet()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $json = '{"agentid":"your-test-agent-id","report_location_flag":0,"logo_mediaid":"xxxxx","name":"NAME","description":"DESC","redirect_domain":"xxxxxx","isreportenter":0,"home_url":"http://www.qq.com"}';
        $data = json_decode($json, true);
        $res = $work->agent->set($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Agent::AGENT_SET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testLists()
    {
        $body = '{"errcode":0,"errmsg":"ok","agentlist":[{"agentid":1,"name":"NAME","square_logo_url":"xxxxxxxx"},{"agentid":2,"name":"NAME","square_logo_url":"xxxxxxxx"}]}';
        $work = $this->getWork($body);

        $res = $work->agent->lists();

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Agent::AGENT_LIST, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
