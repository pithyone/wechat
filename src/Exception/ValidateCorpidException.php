<?php
/**
 * ValidateCorpidException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class ValidateCorpidException.
 */
class ValidateCorpidException extends \Exception
{
    protected $code = -40005;
    protected $message = 'corpid校验错误';
}
