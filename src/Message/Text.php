<?php

namespace WeWork\Message;

class Text implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'MsgType' => 'text',
            'Content' => $this->content
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => $this->content
            ]
        ];
    }
}
