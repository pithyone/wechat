<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class User
{
    use HttpClientTrait;

    /**
     * 创建成员
     *
     * @param array $json
     * @return array
     */
    public function create(array $json): array
    {
        return $this->httpClient->postJson('user/create', $json);
    }

    /**
     * 读取成员
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->httpClient->get('user/get', ['userid' => $id]);
    }

    /**
     * 更新成员
     *
     * @param array $json
     * @return array
     */
    public function update(array $json): array
    {
        return $this->httpClient->postJson('user/update', $json);
    }

    /**
     * 删除成员
     *
     * @param string $id
     * @return array
     */
    public function delete(string $id): array
    {
        return $this->httpClient->get('user/delete', ['userid' => $id]);
    }

    /**
     * 批量删除成员
     *
     * @param array $idList
     * @return array
     */
    public function batchDelete(array $idList): array
    {
        return $this->httpClient->postJson('user/batchdelete', ['useridlist' => $idList]);
    }

    /**
     * 获取部门成员
     *
     * @param int $departmentId
     * @param bool $fetchChild
     * @param bool $needDetail
     * @return array
     */
    public function list(int $departmentId, bool $fetchChild = false, bool $needDetail = false): array
    {
        $uri = 'user/' . ($needDetail ? 'list' : 'simplelist');

        return $this->httpClient->get($uri, ['department_id' => $departmentId, 'fetch_child' => (int)$fetchChild]);
    }

    /**
     * userid转openid
     *
     * @param string $id
     * @return array
     */
    public function convertIdToOpenid(string $id): array
    {
        return $this->httpClient->postJson('user/convert_to_openid', ['userid' => $id]);
    }

    /**
     * openid转userid
     *
     * @param string $openid
     * @return array
     */
    public function convertOpenidToUserId(string $openid): array
    {
        return $this->httpClient->postJson('user/convert_to_userid', compact('openid'));
    }

    /**
     * 二次验证
     *
     * @param string $id
     * @return array
     */
    public function authSuccess(string $id): array
    {
        return $this->httpClient->get('user/authsucc', ['userid' => $id]);
    }

    /**
     * 根据code获取成员信息
     *
     * @param string $code
     * @return array
     */
    public function getInfo(string $code): array
    {
        return $this->httpClient->get('user/getuserinfo', compact('code'));
    }

    /**
     * 使用user_ticket获取成员详情
     *
     * @param string $ticket
     * @return array
     */
    public function getDetail(string $ticket): array
    {
        return $this->httpClient->postJson('user/getuserdetail', ['user_ticket' => $ticket]);
    }
}
