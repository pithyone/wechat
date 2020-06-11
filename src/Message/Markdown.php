<?php

namespace WeWork\Message;

class Markdown implements \WeWork\Message\ResponseMessageInterface
{

    /**
     * @var string
     */
    private $content;

    /**
     * Markdown constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype'  => 'markdown',
            'markdown' => [
                'content' => $this->content,
            ]
        ];
    }
}
