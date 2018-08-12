<?php

namespace WeWork\Crypt;

/**
 * 提供接收和推送给公众平台消息的加解密接口
 */
class PrpCrypt
{
    /**
     * @var string
     */
    public $key = null;

    /**
     * @var string
     */
    public $iv = null;

    /**
     * @param $k
     */
    public function __construct($k)
    {
        $this->key = base64_decode($k . '=');
        $this->iv = substr($this->key, 0, 16);
    }

    /**
     * 加密
     *
     * @param string $text
     * @param string $corpid
     * @return array
     */
    public function encrypt($text, $corpid)
    {
        try {
            //拼接
            $text = $this->getRandomStr() . pack('N', strlen($text)) . $text . $corpid;
            //添加PKCS#7填充
            $pkc_encoder = new PKCS7Encoder;
            $text = $pkc_encoder->encode($text);
            //加密
            $encrypted = openssl_encrypt($text, 'AES-256-CBC', $this->key, OPENSSL_ZERO_PADDING, $this->iv);
            return [ErrorCode::$OK, $encrypted];
        } catch (\Exception $e) {
            return [ErrorCode::$EncryptAESError, null];
        }
    }

    /**
     * 解密
     *
     * @param $encrypted
     * @param $corpid
     * @return array
     */
    public function decrypt($encrypted, $corpid)
    {
        try {
            //解密
            $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $this->key, OPENSSL_ZERO_PADDING, $this->iv);
        } catch (\Exception $e) {
            return [ErrorCode::$DecryptAESError, null];
        }
        try {
            //删除PKCS#7填充
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);
            if (strlen($result) < 16) {
                return [];
            }
            //拆分
            $content = substr($result, 16, strlen($result));
            $len_list = unpack('N', substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_corpid = substr($content, $xml_len + 4);
        } catch (\Exception $e) {
            return [ErrorCode::$IllegalBuffer, null];
        }
        if ($from_corpid != $corpid) {
            return [ErrorCode::$ValidateCorpidError, null];
        }
        return [0, $xml_content];
    }

    /**
     * 生成随机字符串
     *
     * @return string
     */
    public function getRandomStr()
    {
        $str = '';
        $str_pol = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyl';
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }
}
