<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class CRM
{
    use HttpClientTrait;

    /**
     * 获取外部联系人详情
     *
     * @param string $externalUserId
     * @return array
     */
    public function getExternalContact(string $externalUserId): array
    {
        return $this->httpClient->get('crm/get_external_contact', ['external_userid' => $externalUserId]);
    }
}
