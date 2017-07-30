<?php

namespace pithyone\wechat\Message;


class Attribute implements AttributeInterface
{
    /**
     * @return array
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get()
    {
        $vars = call_user_func('get_object_vars', $this);
        $name = $this->getClassName();

        return [
            "msgtype" => $name,
            "$name"   => $vars
        ];
    }

    /**
     * @return string
     * @author wangbing <pithyone@vip.qq.com>
     */
    protected function getClassName()
    {
        $name = get_class($this);

        if (preg_match('@\\\\([\w]+)$@', $name, $matches)) {
            $name = $matches[1];
        }

        return strtolower($name);
    }

    /**
     * @param $var
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    protected function convertToArray(&$var)
    {
        if (is_array($var)) {
            foreach ($var as &$item) {
                $this->convertToArray($item);
            }
        } else {
            $var = is_object($var) ? (array)($var) : $var;
        }
    }
}