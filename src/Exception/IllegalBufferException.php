<?php
/**
 * IllegalBufferException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class IllegalBufferException.
 */
class IllegalBufferException extends \Exception
{
    protected $code = -40008;
    protected $message = '解密后得到的buffer非法';
}
