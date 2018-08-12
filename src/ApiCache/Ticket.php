<?php

namespace WeWork\ApiCache;

use WeWork\Traits\HttpClientTrait;

class Ticket extends AbstractApiCache
{
    use HttpClientTrait;

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        return md5('wework.api.ticket');
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
        $data = $this->httpClient->get('ticket/get', ['type' => 'wx_card']);

        return $data['ticket'];
    }
}
