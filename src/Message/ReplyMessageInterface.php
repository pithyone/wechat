<?php

namespace WeWork\Message;

interface ReplyMessageInterface
{
    /**
     * @return array
     */
    public function formatForReply(): array;
}
