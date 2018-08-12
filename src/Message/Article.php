<?php

namespace WeWork\Message;

class Article implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $picUrl;

    /**
     * @var string
     */
    private $btnTxt;

    /**
     * @param string $title
     * @param string $url
     * @param string $description
     * @param string $picUrl
     * @param string $btnTxt
     */
    public function __construct(string $title, string $url, string $description = '', string $picUrl = '', string $btnTxt = '')
    {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->picUrl = $picUrl;
        $this->btnTxt = $btnTxt;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'Title' => $this->title,
            'Description' => $this->description,
            'PicUrl' => $this->picUrl,
            'Url' => $this->url
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'picurl' => $this->picUrl,
            'btntxt' => $this->btnTxt
        ];
    }
}
