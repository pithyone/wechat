<?php

namespace WeWork\Message;

class Image implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var string
     */
    private $mediaId;

    /**
     * @param string $mediaId
     */
    public function __construct(string $mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'MsgType' => 'image',
            'Image' => [
                'MediaId' => $this->mediaId
            ]
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'image',
            'image' => [
                'media_id' => $this->mediaId
            ]
        ];
    }
}
