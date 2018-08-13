<?php

namespace WeWork\Crypt;

/**
 * 1.第三方回复加密消息给公众平台；
 * 2.第三方收到公众平台发送的消息，验证消息的安全性，并对消息进行解密。
 */
class WXBizMsgCrypt
{
    /**
     * @var string
     */
    private $m_sToken;

    /**
     * @var string
     */
    private $m_sEncodingAesKey;

    /**
     * @var string
     */
    private $m_sCorpid;

    /**
     * 构造函数
     * @param string $token 公众平台上，开发者设置的token
     * @param string $encodingAesKey 公众平台上，开发者设置的EncodingAESKey
     * @param string $Corpid 公众平台的Corpid
     */
    public function __construct($token, $encodingAesKey, $Corpid)
    {
        $this->m_sToken = $token;
        $this->m_sEncodingAesKey = $encodingAesKey;
        $this->m_sCorpid = $Corpid;
    }

    /**
     * 验证URL
     *
     * @param string $sMsgSignature 签名串，对应URL参数的msg_signature
     * @param string $sTimeStamp 时间戳，对应URL参数的timestamp
     * @param string $sNonce 随机串，对应URL参数的nonce
     * @param string $sEchoStr 随机串，对应URL参数的echostr
     * @param string $sReplyEchoStr 解密之后的echostr，当return返回0时有效
     * @return int 成功0，失败返回对应的错误码
     */
    public function VerifyURL($sMsgSignature, $sTimeStamp, $sNonce, $sEchoStr, &$sReplyEchoStr)
    {
        if (strlen($this->m_sEncodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new PrpCrypt($this->m_sEncodingAesKey);
        //verify msg_signature
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->m_sToken, $sTimeStamp, $sNonce, $sEchoStr);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $sMsgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }

        $result = $pc->decrypt($sEchoStr, $this->m_sCorpid);
        if ($result[0] != 0) {
            return $result[0];
        }
        $sReplyEchoStr = $result[1];

        return ErrorCode::$OK;
    }

    /**
     * 将公众平台回复用户的消息加密打包.
     * <ol>
     *    <li>对要发送的消息进行AES-CBC加密</li>
     *    <li>生成安全签名</li>
     *    <li>将消息密文和安全签名打包成xml格式</li>
     * </ol>
     *
     * @param string $sReplyMsg 公众平台待回复用户的消息，xml格式的字符串
     * @param string $sTimeStamp 时间戳，可以自己生成，也可以用URL参数的timestamp
     * @param string $sNonce 随机串，可以自己生成，也可以用URL参数的nonce
     * @param string &$sEncryptMsg 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
     *                      当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function EncryptMsg($sReplyMsg, $sTimeStamp, $sNonce, &$sEncryptMsg)
    {
        $pc = new PrpCrypt($this->m_sEncodingAesKey);

        //加密
        $array = $pc->encrypt($sReplyMsg, $this->m_sCorpid);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($sTimeStamp == null) {
            $sTimeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->m_sToken, $sTimeStamp, $sNonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];

        //生成发送的xml
        $xmlparse = new XMLParse;
        $sEncryptMsg = $xmlparse->generate($encrypt, $signature, $sTimeStamp, $sNonce);
        return ErrorCode::$OK;
    }


    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * <ol>
     *    <li>利用收到的密文生成安全签名，进行签名验证</li>
     *    <li>若验证通过，则提取xml中的加密消息</li>
     *    <li>对消息进行解密</li>
     * </ol>
     *
     * @param string $sMsgSignature 签名串，对应URL参数的msg_signature
     * @param string $sTimeStamp 时间戳 对应URL参数的timestamp
     * @param string $sNonce 随机串，对应URL参数的nonce
     * @param string $sPostData 密文，对应POST请求的数据
     * @param string &$sMsg 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function DecryptMsg($sMsgSignature, $sTimeStamp, $sNonce, $sPostData, &$sMsg)
    {
        if (strlen($this->m_sEncodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new PrpCrypt($this->m_sEncodingAesKey);

        //提取密文
        $xmlparse = new XMLParse;
        $array = $xmlparse->extract($sPostData);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        if ($sTimeStamp == null) {
            $sTimeStamp = time();
        }

        $encrypt = $array[1];

        //验证安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->m_sToken, $sTimeStamp, $sNonce, $encrypt);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $sMsgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }

        $result = $pc->decrypt($encrypt, $this->m_sCorpid);
        if ($result[0] != 0) {
            return $result[0];
        }
        $sMsg = $result[1];

        return ErrorCode::$OK;
    }
}
