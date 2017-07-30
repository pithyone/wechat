<?php

namespace pithyone\wechat\Server;


use pithyone\wechat\Exceptions\ServerException;

class PrpCrypt
{
    public $key;

    /**
     * PrpCrypt constructor.
     *
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = base64_decode($key . "=");
    }

    /**
     * 对明文进行加密
     *
     * @param string $text 需要加密的明文
     * @param string $corpid
     *
     * @return string 加密后的密文
     * @throws ServerException
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function encrypt($text, $corpid)
    {
        try {
            //获得16位随机字符串，填充到明文之前
            $random = $this->getRandomStr();
            $text = $random . pack("N", strlen($text)) . $text . $corpid;

            // 网络字节序
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);

            //使用自定义的填充方式对明文进行补位填充
            $pkc_encoder = new Pkcs7Encoder();
            $text = $pkc_encoder->encode($text);
            mcrypt_generic_init($module, $this->key, $iv);

            //加密
            $encrypted = mcrypt_generic($module, $text);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);

            return base64_encode($encrypted);
        } catch (\Exception $e) {
            throw new ServerException('EncryptAESError');
        }
    }

    /**
     * 对密文进行解密
     *
     * @param string $encrypted 需要解密的密文
     * @param string $corpid
     *
     * @return bool|string 解密得到的明文
     * @throws ServerException
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function decrypt($encrypted, $corpid)
    {
        try {
            //使用BASE64对需要解密的字符串进行解码
            $ciphertext_dec = base64_decode($encrypted);
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            $iv = substr($this->key, 0, 16);
            mcrypt_generic_init($module, $this->key, $iv);

            //解密
            $decrypted = mdecrypt_generic($module, $ciphertext_dec);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (\Exception $e) {
            throw new ServerException('DecryptAESError');
        }

        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder();
            $result = $pkc_encoder->decode($decrypted);

            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16) {
                return "";
            }
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_corpid = substr($content, $xml_len + 4);
        } catch (\Exception $e) {
            throw new ServerException('IllegalBuffer');
        }

        if ($from_corpid != $corpid) {
            throw new ServerException('ValidateCorpidError');
        }

        return $xml_content;
    }

    /**
     * 随机生成16位字符串
     *
     * @return string
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function getRandomStr()
    {
        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;

        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }

        return $str;
    }
}