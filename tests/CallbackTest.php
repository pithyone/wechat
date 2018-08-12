<?php

namespace WeWork\Tests;

use Symfony\Component\HttpFoundation\Request;
use WeWork\Callback;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Message\ReplyMessageInterface;

class CallbackTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetNoContent()
    {
        $request = Request::create('/');

        $callback = new Callback($request, \Mockery::mock(WXBizMsgCrypt::class));

        $this->assertEquals(null, $callback->get('foo'));
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $request = Request::create('/', 'POST', [], [], [], [], 'content');

        $crypt = \Mockery::mock(WXBizMsgCrypt::class);

        $crypt->shouldReceive('DecryptMsg')
            ->once()
            ->with(\Mockery::any(), \Mockery::any(), \Mockery::any(), \Mockery::any(), \Mockery::on(function (&$argument) {
                $argument = '<xml><Foo><![CDATA[bar]]></Foo></xml>';
                return true;
            }));

        $callback = new Callback($request, $crypt);

        $this->assertEquals(null, $callback->get('foo'));

        $this->assertEquals('bar', $callback->get('Foo'));
    }

    /**
     * @return void
     */
    public function testVerifyURLReply()
    {
        $request = Request::create('/?echostr=foo');

        $crypt = \Mockery::mock(WXBizMsgCrypt::class);

        $crypt->shouldReceive('VerifyURL')
            ->once()
            ->with(\Mockery::any(), \Mockery::any(), \Mockery::any(), \Mockery::any(), \Mockery::on(function (&$argument) {
                $argument = 'text';
                return true;
            }));

        $callback = new Callback($request, $crypt);

        $this->assertEquals('text', $callback->reply(\Mockery::mock(ReplyMessageInterface::class)));
    }

    /**
     * @return void
     */
    public function testReply()
    {
        $request = Request::create('/');

        $request->attributes->set('ToUserName', 'toUser');
        $request->attributes->set('FromUserName', 'fromUser');
        $request->attributes->set('CreateTime', 1348831860);

        $replyMessage = \Mockery::mock(ReplyMessageInterface::class);

        $replyMessage->shouldReceive('formatForReply')
            ->once()
            ->withNoArgs()
            ->andReturn(['Foo' => 'bar']);

        $crypt = \Mockery::mock(WXBizMsgCrypt::class);

        $crypt->shouldReceive('EncryptMsg')
            ->once()
            ->with('<xml><Foo><![CDATA[bar]]></Foo><ToUserName><![CDATA[fromUser]]></ToUserName><FromUserName><![CDATA[toUser]]></FromUserName><CreateTime>1348831860</CreateTime></xml>', \Mockery::any(), \Mockery::any(), \Mockery::on(function (&$argument) {
                $argument = 'xml';
                return true;
            }));

        $callback = new Callback($request, $crypt);

        $this->assertEquals('xml', $callback->reply($replyMessage));
    }
}
