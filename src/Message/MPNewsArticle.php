<?php

namespace pithyone\wechat\Message;

/**
 * Class MPNewsArticle.
 */
class MPNewsArticle
{
    /**
     * @var string 标题
     */
    private $title;

    /**
     * @var string 缩略图的media_id
     */
    private $thumbMediaId;

    /**
     * @var string 作者
     */
    private $author;

    /**
     * @var string 点击“阅读原文”之后的页面链接
     */
    private $contentSourceUrl;

    /**
     * @var string 内容，支持html标签，不超过666 K个字节
     */
    private $content;

    /**
     * @var string 消息描述，不超过512个字节，超过会自动截断
     */
    private $digest;

    /**
     * MPNewsArticle constructor.
     *
     * @param string $title
     * @param string $thumbMediaId
     * @param string $content
     * @param string $author
     * @param string $contentSourceUrl
     * @param string $digest
     */
    public function __construct($title, $thumbMediaId, $content, $author = '', $contentSourceUrl = '', $digest = '')
    {
        $this->title = $title;
        $this->thumbMediaId = $thumbMediaId;
        $this->content = $content;
        $this->author = $author;
        $this->contentSourceUrl = $contentSourceUrl;
        $this->digest = $digest;
    }

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
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
    }

    /**
     * @param string $thumbMediaId
     */
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContentSourceUrl()
    {
        return $this->contentSourceUrl;
    }

    /**
     * @param string $contentSourceUrl
     */
    public function setContentSourceUrl($contentSourceUrl)
    {
        $this->contentSourceUrl = $contentSourceUrl;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getDigest()
    {
        return $this->digest;
    }

    /**
     * @param string $digest
     */
    public function setDigest($digest)
    {
        $this->digest = $digest;
    }
}
