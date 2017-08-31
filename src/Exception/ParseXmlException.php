<?php
/**
 * ParseXmlException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class ParseXmlException.
 */
class ParseXmlException extends \Exception
{
    protected $code = -40002;
    protected $message = 'xml解析失败';
}
