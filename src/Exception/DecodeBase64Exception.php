<?php
/**
 * DecodeBase64Exception.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class DecodeBase64Exception.
 */
class DecodeBase64Exception extends \Exception
{
    protected $code = -400010;
    protected $message = 'base64解密失败';
}
