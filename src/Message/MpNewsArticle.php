<?php

namespace pithyone\wechat\Message;

/**
 * Class MpNewsArticle.
 */
class MpNewsArticle
{
    /**
     * @var string 标题，不超过128个字节，超过会自动截断
     */
    public $title;

    /**
     * @var string 图文消息缩略图的media_id, 可以在上传多媒体文件接口中获得。此处thumb_media_id即上传接口返回的media_id
     */
    public $thumb_media_id;

    /**
     * @var string 图文消息的作者，不超过64个字节
     */
    public $author = '';

    /**
     * @var string 图文消息点击“阅读原文”之后的页面链接
     */
    public $content_source_url = '';

    /**
     * @var string 图文消息的内容，支持html标签，不超过666 K个字节
     */
    public $content;

    /**
     * @var string 图文消息的描述，不超过512个字节，超过会自动截断
     */
    public $digest = '';
}
