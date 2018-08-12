<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Tag
{
    use HttpClientTrait;

    /**
     * 创建标签
     *
     * @param string $name
     * @param int $id
     * @return array
     */
    public function create(string $name, int $id = 0): array
    {
        $json = ['tagname' => $name];

        if ($id > 0) {
            $json['tagid'] = $id;
        }

        return $this->httpClient->postJson('tag/create', $json);
    }

    /**
     * 更新标签名字
     *
     * @param int $id
     * @param string $name
     * @return array
     */
    public function update(int $id, string $name): array
    {
        return $this->httpClient->postJson('tag/update', ['tagid' => $id, 'tagname' => $name]);
    }

    /**
     * 删除标签
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        return $this->httpClient->get('tag/delete', ['tagid' => $id]);
    }

    /**
     * 获取标签成员
     *
     * @param int $id
     * @return array
     */
    public function get(int $id): array
    {
        return $this->httpClient->get('tag/get', ['tagid' => $id]);
    }

    /**
     * 增加标签成员
     *
     * @param array $json
     * @return array
     */
    public function addUsers(array $json): array
    {
        return $this->httpClient->postJson('tag/addtagusers', $json);
    }

    /**
     * 删除标签成员
     *
     * @param array $json
     * @return array
     */
    public function delUsers(array $json): array
    {
        return $this->httpClient->postJson('tag/deltagusers', $json);
    }

    /**
     * 获取标签列表
     *
     * @return array
     */
    public function list(): array
    {
        return $this->httpClient->get('tag/list');
    }
}
