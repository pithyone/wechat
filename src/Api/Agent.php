<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;

class Agent
{
    use HttpClientTrait, AgentIdTrait;

    /**
     * 获取应用
     *
     * @return array
     */
    public function get(): array
    {
        return $this->httpClient->get('agent/get', ['agentid' => $this->agentId]);
    }

    /**
     * 设置应用
     *
     * @param array $json
     * @return array
     */
    public function set(array $json): array
    {
        return $this->httpClient->postJson('agent/set', array_merge(['agentid' => $this->agentId], $json));
    }

    /**
     * 获取应用列表
     *
     * @return array
     */
    public function list(): array
    {
        return $this->httpClient->get('agent/list');
    }
}
