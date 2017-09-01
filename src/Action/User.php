<?php

namespace pithyone\wechat\Action;

/**
 * Class User.
 */
class User extends Base
{
    const USER_CREATE = '/cgi-bin/user/create';
    const USER_GET = '/cgi-bin/user/get';
    const USER_UPDATE = '/cgi-bin/user/update';
    const USER_DELETE = '/cgi-bin/user/delete';
    const USER_BATCH_DELETE = '/cgi-bin/user/batchdelete';
    const USER_SIMPLE_LIST = '/cgi-bin/user/simplelist';
    const USER_LIST = '/cgi-bin/user/list';
    const USER_TO_OPENID = '/cgi-bin/user/convert_to_openid';
    const USER_TO_USERID = '/cgi-bin/user/convert_to_userid';
    const USER_AUTH_SUCCESS = '/cgi-bin/user/authsucc';

    /**
     * 创建成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10018
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::USER_CREATE, $data]);
    }

    /**
     * 读取成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10019
     *
     * @param string $userId 成员UserID
     *
     * @return mixed
     */
    public function get($userId)
    {
        return $this->http->response('GET', [self::USER_GET, ['userid' => $userId]]);
    }

    /**
     * 更新成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10020
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update(array $data)
    {
        return $this->http->response('JSON', [self::USER_UPDATE, $data]);
    }

    /**
     * 删除成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10030
     *
     * @param string $userId 成员UserID
     *
     * @return mixed
     */
    public function delete($userId)
    {
        return $this->http->response('GET', [self::USER_DELETE, ['userid' => $userId]]);
    }

    /**
     * 批量删除成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10060
     *
     * @param array $userIdList 成员UserID列表
     *
     * @return mixed
     */
    public function batchDelete(array $userIdList)
    {
        return $this->http->response('JSON', [self::USER_BATCH_DELETE, ['useridlist' => $userIdList]]);
    }

    /**
     * 获取部门成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10061
     *
     * @param int $departmentId 获取的部门id
     * @param int $fetchChild   1/0：是否递归获取子部门下面的成员
     *
     * @return mixed
     */
    public function simpleLists($departmentId, $fetchChild = 1)
    {
        return $this->http->response(
            'GET',
            [self::USER_SIMPLE_LIST, ['department_id' => $departmentId, 'fetch_child' => $fetchChild]]
        );
    }

    /**
     * 获取部门成员详情.
     *
     * @link https://work.weixin.qq.com/api/doc#10063
     *
     * @param int $departmentId 获取的部门id
     * @param int $fetchChild   1/0：是否递归获取子部门下面的成员
     *
     * @return mixed
     */
    public function lists($departmentId, $fetchChild = 1)
    {
        return $this->http->response(
            'GET',
            [self::USER_LIST, ['department_id' => $departmentId, 'fetch_child' => $fetchChild]]
        );
    }

    /**
     * userid转换成openid.
     *
     * @link https://work.weixin.qq.com/api/doc#11279
     *
     * @param string $userId  企业内的成员id
     * @param int    $agentId 整型，需要发送红包的应用ID，若只是使用微信支付和企业转账，则无需该参数
     *
     * @return mixed
     */
    public function convertToOpenId($userId, $agentId = null)
    {
        $json = ['userid' => $userId];
        !is_null($agentId) && $json['agentid'] = $agentId;

        return $this->http->response('JSON', [self::USER_TO_OPENID, $json]);
    }

    /**
     * openid转换成userid.
     *
     * @link https://work.weixin.qq.com/api/doc#11279
     *
     * @param string $openId 在使用微信支付、微信红包和企业转账之后，返回结果的openid
     *
     * @return mixed
     */
    public function convertToUserId($openId)
    {
        return $this->http->response('JSON', [self::USER_TO_USERID, ['openid' => $openId]]);
    }

    /**
     * 二次验证
     *
     * @link https://work.weixin.qq.com/api/doc#11378
     *
     * @param string $userId 成员UserID
     *
     * @return mixed
     */
    public function authSuccess($userId)
    {
        return $this->http->response('GET', [self::USER_AUTH_SUCCESS, ['userid' => $userId]]);
    }
}
