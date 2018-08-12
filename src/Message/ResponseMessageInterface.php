<?php

namespace WeWork\Message;

interface ResponseMessageInterface
{
    /**
     * @return array
     */
    public function formatForResponse(): array;
}
