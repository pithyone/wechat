<?php

namespace pithyone\wechat\Server;

/**
 * Class PKCS7Encoder.
 */
class PKCS7Encoder
{
    public static $block_size = 32;

    /**
     * 对需要加密的明文进行填�.
     *
     * 补位
     *
     * @param string $text 需要进行填�
     *
     * 补位操作的明文
     *
     * @return string 补齐明文字符串
     */
    public function encode($text)
    {
        $text_length = strlen($text);

        //计算需要填充的位数
        $amount_to_pad = self::$block_size - ($text_length % self::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = self::$block_size;
        }

        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = '';
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }

        return $text.$tmp;
    }

    /**
     * 对解密后的明文进行补位删除.
     *
     * @param string $text 解密后的明文
     *
     * @return bool|string 删除填�
     *
     * 补位后的明文
     */
    public function decode($text)
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > self::$block_size) {
            $pad = 0;
        }

        return substr($text, 0, (strlen($text) - $pad));
    }
}
