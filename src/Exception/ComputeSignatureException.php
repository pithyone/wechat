<?php
/**
 * ComputeSignatureException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class ComputeSignatureException.
 */
class ComputeSignatureException extends \Exception
{
    protected $code = -40003;
    protected $message = 'sha加密生成签名失败';
}
