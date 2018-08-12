<?php

namespace WeWork\Message;

class TextCard implements ResponseMessageInterface
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
    private $btnTxt;

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $btnTxt
     */
    public function __construct(string $title, string $description, string $url, string $btnTxt = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->btnTxt = $btnTxt;
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'textcard',
            'textcard' => [
                'title' => $this->title,
                'description' => $this->description,
                'url' => $this->url,
                'btntxt' => $this->btnTxt
            ]
        ];
    }
}
