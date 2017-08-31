<?php
/**
 * BatchTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Batch;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class BatchTest.
 */
class BatchTest extends AbstractTestCase
{
    public function testSyncUser()
    {
        $body = '{"errcode":0,"errmsg":"ok","jobid":"xxxxx"}';
        $work = $this->getWork($body);

        $json = '{"media_id":"xxxxxx","callback":{"url":"xxx","token":"xxx","encodingaeskey":"xxx"}}';
        $data = json_decode($json, true);
        $res = $work->batch->syncUser($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Batch::BATCH_SYNC_USER, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testReplaceUser()
    {
        $body = '{"errcode":0,"errmsg":"ok","jobid":"xxxxx"}';
        $work = $this->getWork($body);

        $json = '{"media_id":"xxxxxx","callback":{"url":"xxx","token":"xxx","encodingaeskey":"xxx"}}';
        $data = json_decode($json, true);
        $res = $work->batch->replaceUser($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Batch::BATCH_REPLACE_USER, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testReplaceParty()
    {
        $body = '{"errcode":0,"errmsg":"ok","jobid":"xxxxx"}';
        $work = $this->getWork($body);

        $json = '{"media_id":"xxxxxx","callback":{"url":"xxx","token":"xxx","encodingaeskey":"xxx"}}';
        $data = json_decode($json, true);
        $res = $work->batch->replaceParty($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Batch::BATCH_REPLACE_PARTY, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testResult()
    {
        $body = '{"errcode":0,"errmsg":"ok","status":1,"type":"replace_user","total":3,"percentage":33}';
        $work = $this->getWork($body);

        $jobId = 'xxxxx';
        $res = $work->batch->result($jobId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Batch::BATCH_GET_RESULT, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($jobId, $res['options']['query']['jobid']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
