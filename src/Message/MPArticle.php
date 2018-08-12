<?php

namespace WeWork\Message;

class MPArticle implements ResponseMessageInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $thumbMediaId;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $contentSourceUrl;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $digest;

    /**
     * @param string $title
     * @param string $thumbMediaId
     * @param string $content
     * @param string $author
     * @param string $contentSourceUrl
     * @param string $digest
     */
    public function __construct(string $title, string $thumbMediaId, string $content, string $author = '', string $contentSourceUrl = '', string $digest = '')
    {
        $this->title = $title;
        $this->thumbMediaId = $thumbMediaId;
        $this->content = $content;
        $this->author = $author;
        $this->contentSourceUrl = $contentSourceUrl;
        $this->digest = $digest;
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'title' => $this->title,
            'thumb_media_id' => $this->thumbMediaId,
            'author' => $this->author,
            'content_source_url' => $this->contentSourceUrl,
            'content' => $this->content,
            'digest' => $this->digest
        ];
    }
}
