<?php

namespace pithyone\wechat\Message;

/**
 * Class TextCard.
 */
class TextCard extends Attribute
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $btntxt = '详情';
}
