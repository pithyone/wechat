<?php
/**
 * EncryptAESException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class EncryptAESException.
 */
class EncryptAESException extends \Exception
{
    protected $code = -40006;
    protected $message = 'aes加密失败';
}
