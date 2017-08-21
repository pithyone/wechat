<?php

namespace pithyone\wechat\Core;

use LSS\Array2XML;

/**
 * Class XML.
 */
class XML
{
    /**
     * @param array $data
     *
     * @return string
     */
    public static function build(array $data)
    {
        self::parseArray($data);
        $domDocument = Array2XML::createXML('xml', $data);

        return $domDocument->saveXML($domDocument->firstChild);
    }

    /**
     * @param array $array
     */
    protected static function parseArray(array &$array)
    {
        foreach ($array as $key => &$item) {
            if (is_string($item)) {
                $item = ['@cdata' => $item];
            } elseif (is_array($item)) {
                if (count($item) != count($item, 1)) {
                    foreach ($item as &$value) {
                        self::parseArray($value);
                    }
                    $item = ['item' => $item];
                } else {
                    self::parseArray($item);
                }
            }
        }
    }
}
