<?php

namespace pithyone\wechat\Message;

/**
 * Class Video.
 */
class Video extends Attribute
{
    /**
     * @var string
     */
    public $media_id;

    /**
     * @var string
     */
    public $title = '';

    /**
     * @var string
     */
    public $description = '';
}
