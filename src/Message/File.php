<?php

namespace WeWork\Message;

class File implements ResponseMessageInterface
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
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'file',
            'file' => [
                'media_id' => $this->mediaId
            ]
        ];
    }
}
