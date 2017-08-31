<?php

namespace pithyone\wechat\Message;

/**
 * Class NewsArticle.
 */
class NewsArticle
{
    /**
     * @var string 标题
     */
    private $title;

    /**
     * @var string 描述
     */
    private $description;

    /**
     * @var string 点击后跳转的链接
     */
    private $url;

    /**
     * @var string 图文消息的图片链接
     */
    private $picUrl;

    /**
     * NewsArticle constructor.
     *
     * @param string $title
     * @param string $url
     * @param string $description
     * @param string $picUrl
     * @param string $btnTxt
     */
    public function __construct($title, $url, $description = '', $picUrl = '', $btnTxt = '阅读全文')
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->picUrl = $picUrl;
        $this->btnTxt = $btnTxt;
    }

    /**
     * @var string 按钮文字，仅在图文数为1条时才生效。该设置只在企业微信上生效，微信插件上不生效
     */
    private $btnTxt;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getPicUrl()
    {
        return $this->picUrl;
    }

    /**
     * @param string $picUrl
     */
    public function setPicUrl($picUrl)
    {
        $this->picUrl = $picUrl;
    }

    /**
     * @return string
     */
    public function getBtnTxt()
    {
        return $this->btnTxt;
    }

    /**
     * @param string $btnTxt
     */
    public function setBtnTxt($btnTxt)
    {
        $this->btnTxt = $btnTxt;
    }
}
