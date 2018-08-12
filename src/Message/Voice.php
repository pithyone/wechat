<?php

namespace WeWork\Message;

class Voice implements ResponseMessageInterface, ReplyMessageInterface
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
            'MsgType' => 'voice',
            'Voice' => [
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
            'msgtype' => 'voice',
            'voice' => [
                'media_id' => $this->mediaId
            ]
        ];
    }
}
