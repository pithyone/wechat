<?php
/**
 * CorpTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Corp;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class CorpTest.
 */
class CorpTest extends AbstractTestCase
{
    public function testGetCheckInData()
    {
        $body = '{"errcode":0,"errmsg":"ok","result":[{"userid":"james","groupname":"打卡一组","checkin_type":"上班打卡","exception_type":"地点异常","checkin_time":1492617610,"location_title":"依澜府","location_detail":"四川省成都市武侯区益州大道中段784号附近","wifiname":"办公一区","notes":"路上堵车，迟到了5分钟","wifimac":"3c:46:d8:0c:7a:70","mediaids":["WWCISP_G8PYgRaOVHjXWUWFqchpBqqqUpGj0OyR9z6WTwhnMZGCPHxyviVstiv_2fTG8YOJq8L8zJT2T2OvTebANV-2MQ"]},{"userid":"paul","groupname":"打卡二组","checkin_type":"外出打卡","exception_type":"时间异常","checkin_time":1492617620,"location_title":"重庆出口加工区","location_detail":"重庆市渝北区金渝大道101号金渝大道","wifiname":"办公室二区","notes":"","wifimac":"3c:46:d8:0c:7a:71","mediaids":["WWCISP_G8PYgRaOVHjXWUWFqchpBqqqUpGj0OyR9z6WTwhnMZGCPHxyviVstiv_2fTG8YOJq8L8zJT2T2OvTebANV-2MQ"]}]}';
        $work = $this->getWork($body);

        $json = '{"opencheckindatatype":3,"starttime":1492617600,"endtime":1492790400,"useridlist":["james","paul"]}';
        $data = json_decode($json, true);
        $res = $work->corp->getCheckInData($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Corp::CHECK_IN_GET_CHECK_IN_DATA, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGetApprovalData()
    {
        $body = '{"errcode":0,"errmsg":"ok","count":3,"total":5,"next_spnum":201704240001,"data":[{"spname":"报销","apply_name":"报销测试","apply_org":"报销测试企业","approval_name":["审批人测试"],"notify_name":["抄送人测试"],"sp_status":1,"sp_num":201704200001,"mediaids":["WWCISP_G8PYgRaOVHjXWUWFqchpBqqqUpGj0OyR9z6WTwhnMZGCPHxyviVstiv_2fTG8YOJq8L8zJT2T2OvTebANV-2MQ"],"apply_time":1499153693,"apply_user_id":"testuser","expense":{"expense_type":1,"reason":"","item":[{"expenseitem_type":6,"time":1492617600,"sums":9900,"reason":""}]}},{"spname":"请假","apply_name":"请假测试","apply_org":"请假测试企业","approval_name":["审批人测试"],"notify_name":["抄送人测试"],"sp_status":1,"sp_num":201704200004,"apply_time":1499153693,"apply_user_id":"testuser","leave":{"timeunit":0,"leave_type":4,"start_time":1492099200,"end_time":1492790400,"duration":144,"reason":""}},{"spname":"自定义审批","apply_name":"自定义","apply_org":"自定义测试企业","approval_name":["自定义审批人"],"notify_name":["自定义抄送人"],"sp_status":1,"sp_num":201704240001,"apply_time":1499153693,"apply_user_id":"testuser","comm":{"apply_data":{"item-1492610773696":{"title":"abc","type":"text","value":""}}}}]}';
        $work = $this->getWork($body);

        $json = '{"starttime":1492617600,"endtime":1492790400,"next_spnum":201704200003}';
        $data = json_decode($json, true);
        $res = $work->corp->getApprovalData($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Corp::CORP_GET_APPROVAL_DATA, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
