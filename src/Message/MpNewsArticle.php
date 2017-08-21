<?php

namespace pithyone\wechat\Message;

/**
 * Class MpNewsArticle.
 */
class MpNewsArticle
{
    /**
     * @var string 标题，不�
     * 过128个字节，�
     * 过会自动截断
     */
    public $title;

    /**
     * @var string 图文消息缩略图的media_id, 可以在上传多媒体文件接口中获得。此处thumb_media_id即上传接口返回的media_id
     */
    public $thumb_media_id;

    /**
     * @var string 图文消息的作�
     * ，不�
     * 过64个字节
     */
    public $author = '';

    /**
     * @var string 图文消息点击“�
     * 读原文”之后的页面链接
     */
    public $content_source_url = '';

    /**
     * @var string 图文消息的�
     * 容，支持html标签，不�
     * 过666 K个字节
     */
    public $content;

    /**
     * @var string 图文消息的描述，不�
     * 过512个字节，�
     * 过会自动截断
     */
    public $digest = '';
}
