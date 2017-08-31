<?php
/**
 * IllegalAesKeyException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class IllegalAesKeyException.
 */
class IllegalAesKeyException extends \Exception
{
    protected $code = -40004;
    protected $message = 'encodingAesKey非法';
}
