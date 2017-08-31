<?php
/**
 * GenReturnXmlException.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Exception;

/**
 * Class GenReturnXmlException.
 */
class GenReturnXmlException extends \Exception
{
    protected $code = -400011;
    protected $message = '生成xml失败';
}
