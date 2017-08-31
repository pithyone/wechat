<?php
/**
 * ValidateSignatureException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class ValidateSignatureException.
 */
class ValidateSignatureException extends \Exception
{
    protected $code = -40001;
    protected $message = '签名验证错误';
}
