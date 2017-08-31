<?php
/**
 * MessageTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Message;
use pithyone\wechat\Message\MPNewsArticle;
use pithyone\wechat\Message\NewsArticle;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class MessageTest.
 */
class MessageTest extends AbstractTestCase
{
    public function testSend()
    {
        $body = '{"errcode":0,"errmsg":"ok","invaliduser":"UserID1","invalidparty":"PartyID1","invalidtag":"TagID1"}';
        $work = $this->getWork($body);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->text('this is a test')
            ->send();

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Message::MESSAGE_SEND, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"text","agentid":"your-test-agent-id","text":{"content":"this is a test"},"safe":0}',
            true
        ), $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->media('image', 'MEDIA_ID')
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"image","agentid":"your-test-agent-id","image":{"media_id":"MEDIA_ID"},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->media('voice', 'MEDIA_ID')
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"voice","agentid":"your-test-agent-id","voice":{"media_id":"MEDIA_ID"},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->media('file', 'MEDIA_ID')
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"file","agentid":"your-test-agent-id","file":{"media_id":"MEDIA_ID"},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->video('MEDIA_ID', 'Title', 'Description')
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"video","agentid":"your-test-agent-id","video":{"media_id":"MEDIA_ID","title":"Title","description":"Description"},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->textCard('Title', 'Description', 'URL', '更多')
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"textcard","agentid":"your-test-agent-id","textcard":{"title":"Title","description":"Description","url":"URL","btntxt":"更多"},"safe":0}',
            true
        ), $res['options']['json']);

        $article = new NewsArticle(
            '中秋节礼品领取',
            'URL',
            '今年中秋节公司有豪礼相送',
            'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png',
            '更多'
        );

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->news('news', $article)
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"news","agentid":"your-test-agent-id","news":{"articles":[{"title":"中秋节礼品领取","description":"今年中秋节公司有豪礼相送","url":"URL","picurl":"http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png","btntxt":"更多"}]},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->news('news', [$article])
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"news","agentid":"your-test-agent-id","news":{"articles":[{"title":"中秋节礼品领取","description":"今年中秋节公司有豪礼相送","url":"URL","picurl":"http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png","btntxt":"更多"}]},"safe":0}',
            true
        ), $res['options']['json']);

        $article = new MpNewsArticle(
            'Title',
            '1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p',
            'Content',
            'Author',
            'http://www.soso.com',
            'Digest description'
        );

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->news('mpnews', $article)
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"mpnews","agentid":"your-test-agent-id","mpnews":{"articles":[{"title":"Title","thumb_media_id":"1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p","author":"Author","content_source_url":"http://www.soso.com","content":"Content","digest":"Digest description"}]},"safe":0}',
            true
        ), $res['options']['json']);

        $res = $work
            ->message
            ->touser(['UserID1', 'UserID2', 'UserID3'])
            ->toparty(['PartyID1', 'PartyID2'])
            ->totag(['TagID1', 'TagID2'])
            ->safe(0)
            ->news('mpnews', [$article])
            ->send();

        $this->assertEquals(json_decode(
            '{"touser":"UserID1|UserID2|UserID3","toparty":"PartyID1|PartyID2","totag":"TagID1|TagID2","msgtype":"mpnews","agentid":"your-test-agent-id","mpnews":{"articles":[{"title":"Title","thumb_media_id":"1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p","author":"Author","content_source_url":"http://www.soso.com","content":"Content","digest":"Digest description"}]},"safe":0}',
            true
        ), $res['options']['json']);
    }
}
