<?php

namespace WeWork\ApiCache;

use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\SecretTrait;

class Token extends AbstractApiCache
{
    use CorpIdTrait, SecretTrait, HttpClientTrait;

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        $unique = md5($this->secret);

        return md5('wework.api.token.' . $unique);
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
        $data = $this->httpClient->get('gettoken', ['corpid' => $this->corpId, 'corpsecret' => $this->secret]);

        return $data['access_token'];
    }
}
