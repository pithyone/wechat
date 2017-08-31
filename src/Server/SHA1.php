<?php

namespace pithyone\wechat\Server;

use pithyone\wechat\Exception\ComputeSignatureException;

/**
 * Class SHA1.
 */
class SHA1
{
    /**
     * 用SHA1算法生成安全签名.
     *
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt_msg 密文消息
     *
     * @throws ComputeSignatureException
     *
     * @return string
     */
    public function get($token, $timestamp, $nonce, $encrypt_msg)
    {
        try {
            $array = [$encrypt_msg, $token, $timestamp, $nonce];
            sort($array, SORT_STRING);
            $str = implode($array);

            return sha1($str);
        } catch (\Exception $e) {
            throw new ComputeSignatureException();
        }
    }
}
