<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;

class Menu
{
    use HttpClientTrait, AgentIdTrait;

    /**
     * 创建菜单
     *
     * @param array $json
     * @return array
     */
    public function create(array $json): array
    {
        return $this->httpClient->postJson('menu/create', $json, ['agentid' => $this->agentId]);
    }

    /**
     * 获取菜单
     *
     * @return array
     */
    public function get(): array
    {
        return $this->httpClient->get('menu/get', ['agentid' => $this->agentId]);
    }

    /**
     * 删除菜单
     *
     * @return array
     */
    public function delete(): array
    {
        return $this->httpClient->get('menu/delete', ['agentid' => $this->agentId]);
    }
}
