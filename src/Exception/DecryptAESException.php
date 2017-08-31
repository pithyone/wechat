<?php
/**
 * DecryptAESException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class DecryptAESException.
 */
class DecryptAESException extends \Exception
{
    protected $code = -40007;
    protected $message = 'aes解密失败';
}
