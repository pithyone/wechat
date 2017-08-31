<?php
/**
 * EncodeBase64Exception.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class EncodeBase64Exception.
 */
class EncodeBase64Exception extends \Exception
{
    protected $code = -40009;
    protected $message = 'base64加密失败';
}
