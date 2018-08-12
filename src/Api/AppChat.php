<?php

namespace WeWork\Api;

use WeWork\Message\ResponseMessageInterface;
use WeWork\Traits\HttpClientTrait;

class AppChat
{
    use HttpClientTrait;

    /**
     * 创建群聊会话
     *
     * @param array $json
     * @return array
     */
    public function create(array $json): array
    {
        return $this->httpClient->postJson('appchat/create', $json);
    }

    /**
     * 修改群聊会话
     *
     * @param array $json
     * @return array
     */
    public function update(array $json): array
    {
        return $this->httpClient->postJson('appchat/update', $json);
    }

    /**
     * 获取群聊会话
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->httpClient->get('appchat/get', ['chatid' => $id]);
    }

    /**
     * 应用推送消息
     *
     * @param string $id
     * @param ResponseMessageInterface $responseMessage
     * @param bool $safe
     * @return array
     */
    public function send(string $id, ResponseMessageInterface $responseMessage, bool $safe = false): array
    {
        return $this->httpClient->postJson(
            'appchat/send',
            array_merge(['chatid' => $id], $responseMessage->formatForResponse(), ['safe' => (int)$safe])
        );
    }
}
