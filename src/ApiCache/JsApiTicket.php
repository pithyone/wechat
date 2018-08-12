<?php

namespace WeWork\ApiCache;

use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\SecretTrait;

class JsApiTicket extends AbstractApiCache
{
    use SecretTrait, HttpClientTrait;

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        $unique = md5($this->secret);

        return md5('wework.api.js_ticket.' . $unique);
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
        $data = $this->httpClient->get('get_jsapi_ticket');

        return $data['ticket'];
    }
}
