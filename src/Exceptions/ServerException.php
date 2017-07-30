<?php

namespace pithyone\wechat\Exceptions;


use Throwable;

class ServerException extends \Exception
{
    /**
     * @var array
     */
    protected $error = [
        'ValidateSignatureError' => [
            'code'    => -40001,
            'message' => '签名验证错误'
        ],
        'ParseXmlError'          => [
            'code'    => -40002,
            'message' => 'xml解析失败'
        ],
        'ComputeSignatureError'  => [
            'code'    => -40003,
            'message' => 'sha加密生成签名失败'
        ],
        'IllegalAesKey'          => [
            'code'    => -40004,
            'message' => 'encodingAesKey 非法'
        ],
        'ValidateCorpidError'    => [
            'code'    => -40005,
            'message' => 'corpid 校验错误'
        ],
        'EncryptAESError'        => [
            'code'    => -40006,
            'message' => 'aes 加密失败'
        ],
        'DecryptAESError'        => [
            'code'    => -40007,
            'message' => 'aes 解密失败'
        ],
        'IllegalBuffer'          => [
            'code'    => -40008,
            'message' => '解密后得到的buffer非法'
        ],
        'EncodeBase64Error'      => [
            'code'    => -40009,
            'message' => 'base64加密失败'
        ],
        'DecodeBase64Error'      => [
            'code'    => -400010,
            'message' => 'base64解密失败'
        ],
        'GenReturnXmlError'      => [
            'code'    => -400011,
            'message' => '生成xml失败'
        ],
    ];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (isset($this->error[$message])) {
            $message = $this->error[$message]['message'];
            $code = $this->error[$message]['code'];
        }

        parent::__construct($message, $code, $previous);
    }
}