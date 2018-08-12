<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Department
{
    use HttpClientTrait;

    /**
     * 创建部门
     *
     * @param array $json
     * @return array
     */
    public function create(array $json): array
    {
        return $this->httpClient->postJson('department/create', $json);
    }

    /**
     * 更新部门
     *
     * @param array $json
     * @return array
     */
    public function update(array $json): array
    {
        return $this->httpClient->postJson('department/update', $json);
    }

    /**
     * 删除部门
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        return $this->httpClient->get('department/delete', compact('id'));
    }

    /**
     * 获取部门列表
     *
     * @param int $id
     * @return array
     */
    public function list(int $id = 0): array
    {
        return $this->httpClient->get('department/list', $id > 0 ? compact('id') : []);
    }
}
