<?php

namespace pithyone\wechat\Message;

/**
 * Class News.
 *
 * @property mixed $articles
 */
class News extends Attribute
{
    /**
     * @param $name
     * @param $value
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function __set($name, $value)
    {
        $this->convertToArray($value);
        $this->$name = count($value) == count($value, 1) ? [$value] : $value;
    }
}
