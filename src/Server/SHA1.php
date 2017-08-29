<?php

namespace pithyone\wechat\Server;

use pithyone\wechat\Exceptions\ServerException;

/**
 * Class SHA1.
 *
 * 计算企业微信的消息签名接口
 */
class SHA1
{
    /**
     * 用SHA1算法生成安全签名.
     *
     * @param string $token       票据
     * @param string $timestamp   时间戳
     * @param string $nonce       随机字符串
     * @param string $encrypt_msg 密文消息
     *
     * @throws ServerException
     *
     * @return string
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get($token, $timestamp, $nonce, $encrypt_msg)
    {
        try {
            $array = [$encrypt_msg, $token, $timestamp, $nonce];
            sort($array, SORT_STRING);
            $str = implode($array);

            return sha1($str);
        } catch (\Exception $e) {
            throw new ServerException('ComputeSignatureError');
        }
    }
}
