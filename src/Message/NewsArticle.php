<?php

namespace pithyone\wechat\Message;

/**
 * Class NewsArticle.
 */
class NewsArticle
{
    /**
     * @var string 标题，不�
     * 过128个字节，�
     * 过会自动截断
     */
    public $title;

    /**
     * @var string 描述，不�
     * 过512个字节，�
     * 过会自动截断
     */
    public $description = '';

    /**
     * @var string 点击后跳转的链接
     */
    public $url = '';

    /**
     * @var string 图文消息的图片链接，支持JPG、PNG格式，较好的效果为大图640320，小图8080
     */
    public $picurl = '';

    /**
     * @var string 按钮文字，�
     * 在图文数为1条时才生效。 默认为“�
     * 读�
     * �文”， 不�
     * 过4个文字，�
     * 过自动截断。
     */
    public $btntxt = '阅读全文';
}
