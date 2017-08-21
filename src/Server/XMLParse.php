<?php

namespace pithyone\wechat\Server;

use pithyone\wechat\Exceptions\ServerException;

/**
 * Class XMLParse.
 */
class XMLParse
{
    /**
     * 提取出xml数据�
     * 中的加密消息.
     *
     * @param string $xmltext �
     * 提取的xml字符串
     *
     * @throws ServerException
     *
     * @return string
     */
    public function extract($xmltext)
    {
        try {
            $xml = new \DOMDocument();
            $xml->loadXML($xmltext);
            $array_e = $xml->getElementsByTagName('Encrypt');
            $encrypt = $array_e->item(0)->nodeValue;

            return $encrypt;
        } catch (\Exception $e) {
            throw new ServerException('ParseXmlError');
        }
    }

    /**
     * 生成xml消息.
     *
     * @param string $encrypt 加密后的消息密文
     * @param string $signature 安�
     * �签名
     * @param string $timestamp 时间戳
     * @param string $nonce     随机字符串
     *
     * @return string
     */
    public function generate($encrypt, $signature, $timestamp, $nonce)
    {
        $format = '<xml>
<Encrypt><![CDATA[%s]]></Encrypt>
<MsgSignature><![CDATA[%s]]></MsgSignature>
<TimeStamp>%s</TimeStamp>
<Nonce><![CDATA[%s]]></Nonce>
</xml>';

        return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
    }
}
