<?php

namespace WeWork\Tests\Crypt;

use DOMDocument;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Tests\TestCase;

class WXBizMsgCryptTest extends TestCase
{
    /**
     * @var WXBizMsgCrypt
     */
    private $wxcpt;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $encodingAesKey = "jWmYm7qr5nMoAUwZRjGtBxmz3KA1tkAj3ykkR6q2B2C";
        $token = "QDG6eK";
        $corpId = "wx5823bf96d3bd56c7";

        $this->wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
    }

    /**
     * @return void
     */
    public function testVerifyURL()
    {
        $sVerifyMsgSig = "5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
        $sVerifyTimeStamp = "1409659589";
        $sVerifyNonce = "263014780";
        $sVerifyEchoStr = "P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==";

        $sEchoStr = '';

        $this->wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);

        $this->assertEquals('1616140317555161061', $sEchoStr);
    }

    /**
     * @return void
     */
    public function testDecryptMsg()
    {
        $sReqMsgSig = "477715d11cdb4164915debcba66cb864d751f3e6";
        $sReqTimeStamp = "1409659813";
        $sReqNonce = "1372623149";
        $sReqData = "<xml><ToUserName><![CDATA[wx5823bf96d3bd56c7]]></ToUserName><Encrypt><![CDATA[RypEvHKD8QQKFhvQ6QleEB4J58tiPdvo+rtK1I9qca6aM/wvqnLSV5zEPeusUiX5L5X/0lWfrf0QADHHhGd3QczcdCUpj911L3vg3W/sYYvuJTs3TUUkSUXxaccAS0qhxchrRYt66wiSpGLYL42aM6A8dTT+6k4aSknmPj48kzJs8qLjvd4Xgpue06DOdnLxAUHzM6+kDZ+HMZfJYuR+LtwGc2hgf5gsijff0ekUNXZiqATP7PF5mZxZ3Izoun1s4zG4LUMnvw2r+KqCKIw+3IQH03v+BCA9nMELNqbSf6tiWSrXJB3LAVGUcallcrw8V2t9EL4EhzJWrQUax5wLVMNS0+rUPA3k22Ncx4XXZS9o0MBH27Bo6BpNelZpS+/uh9KsNlY6bHCmJU9p8g7m3fVKn28H3KDYA5Pl/T8Z1ptDAVe0lXdQ2YoyyH2uyPIGHBZZIs2pDBS8R07+qN+E7Q==]]></Encrypt><AgentID><![CDATA[218]]></AgentID></xml>";

        $sMsg = '';  // 解析之后的明文

        $this->wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sReqData, $sMsg);

        $this->assertEquals("<xml><ToUserName><![CDATA[wx5823bf96d3bd56c7]]></ToUserName>
<FromUserName><![CDATA[mycreate]]></FromUserName>
<CreateTime>1409659813</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[hello]]></Content>
<MsgId>4561255354251345929</MsgId>
<AgentID>218</AgentID>
</xml>", $sMsg);
    }

    /**
     * @return void
     */
    public function testEncryptMsg()
    {
        $sReqTimeStamp = "1409659813";
        $sReqNonce = "1372623149";

        // 需要发送的明文
        $sRespData = "<xml><ToUserName><![CDATA[mycreate]]></ToUserName><FromUserName><![CDATA[wx5823bf96d3bd56c7]]></FromUserName><CreateTime>1348831860</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[this is a test]]></Content><MsgId>1234567890123456</MsgId><AgentID>128</AgentID></xml>";

        $sEncryptMsg = ''; //xml格式的密文

        $this->wxcpt->EncryptMsg($sRespData, $sReqTimeStamp, $sReqNonce, $sEncryptMsg);

        $xml = new DOMDocument();
        $xml->loadXML($sEncryptMsg);
        $sReqMsgSig = $xml->getElementsByTagName('MsgSignature')->item(0)->nodeValue;

        $sMsg = '';  // 解析之后的明文

        $this->wxcpt->DecryptMsg($sReqMsgSig, $sReqTimeStamp, $sReqNonce, $sEncryptMsg, $sMsg);

        $this->assertEquals($sRespData, $sMsg);
    }
}
