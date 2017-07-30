<?php

namespace pithyone\wechat\Action;


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
     * 创建成员
     *
     * @param array $data
     *
     * {
     * "userid": "zhangsan",
     * "name": "张三",
     * "english_name": "jackzhang"
     * "mobile": "15913215421",
     * "department": [1, 2],
     * "order":[10,40],
     * "position": "产品经理",
     * "gender": "1",
     * "email": "zhangsan@gzdev.com",
     * "isleader": 1,
     * "enable":1,
     * "avatar_mediaid": "2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0",
     * "telephone": "020-123456"，
     * "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
     * }
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::USER_CREATE, $data]);
    }

    /**
     * 读取成员
     *
     * @param string $userid 成员UserID
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get($userid)
    {
        return $this->http->response('GET', [self::USER_GET, ['userid' => $userid]]);
    }

    /**
     * 更新成员
     *
     * @param array $data
     *
     * {
     * "userid": "zhangsan",
     * "name": "李四",
     * "department": [1],
     * "order"：[10],
     * "position": "后台工程师",
     * "mobile": "15913215421",
     * "gender": "1",
     * "email": "zhangsan@gzdev.com",
     * "isleader": 0,
     * "enable": 1,
     * "avatar_mediaid": "2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0",
     * "telephone": "020-123456",
     * "english_name": "jackzhang",
     * "extattr": {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}
     * }
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function update(array $data)
    {
        return $this->http->response('JSON', [self::USER_UPDATE, $data]);
    }

    /**
     * 删除成员
     *
     * @param string $userid 成员UserID
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function delete($userid)
    {
        return $this->http->response('GET', [self::USER_DELETE, ['userid' => $userid]]);
    }

    /**
     * 批量删除成员
     *
     * @param array $useridlist 成员UserID列表
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function batchDelete(array $useridlist)
    {
        return $this->http->response('JSON', [self::USER_BATCH_DELETE, ['useridlist' => $useridlist]]);
    }


    /**
     * 获取部门成员
     *
     * @param int $department_id 获取的部门id
     * @param int $fetch_child   1/0：是否递归获取子部门下面的成员
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function simpleLists($department_id, $fetch_child = 1)
    {
        return $this->http->response('GET', [
            self::USER_SIMPLE_LIST, ['department_id' => $department_id, 'fetch_child' => $fetch_child]
        ]);
    }

    /**
     * 获取部门成员详情
     *
     * @param int $department_id 获取的部门id
     * @param int $fetch_child   1/0：是否递归获取子部门下面的成员
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function lists($department_id, $fetch_child = 1)
    {
        return $this->http->response('GET', [
            self::USER_LIST, ['department_id' => $department_id, 'fetch_child' => $fetch_child]
        ]);
    }

    /**
     * userid转换成openid
     *
     * @param string $userid  企业内的成员id
     * @param int    $agentid 整型，需要发送红包的应用ID，若只是使用微信支付和企业转账，则无需该参数
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function convertToOpenId($userid, $agentid = null)
    {
        $json = ['userid' => $userid];
        !is_null($agentid) && $json['agentid'] = $agentid;

        return $this->http->response('JSON', [self::USER_TO_OPENID, $json]);
    }

    /**
     * openid转换成userid
     *
     * @param string $open_id 在使用微信支付、微信红包和企业转账之后，返回结果的openid
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function convertToUserId($open_id)
    {
        return $this->http->response('JSON', [self::USER_TO_USERID, ['openid' => $open_id]]);
    }

    /**
     * 二次验证
     *
     * @param string $userid 成员UserID
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function authSuccess($userid)
    {
        return $this->http->response('GET', [self::USER_AUTH_SUCCESS, ['userid' => $userid]]);
    }
}