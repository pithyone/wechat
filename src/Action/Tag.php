<?php

namespace pithyone\wechat\Action;

class Tag extends Base
{
    const TAG_CREATE = '/cgi-bin/tag/create';
    const TAG_UPDATE = '/cgi-bin/tag/update';
    const TAG_DELETE = '/cgi-bin/tag/delete';
    const TAG_GET = '/cgi-bin/tag/get';
    const TAG_ADD_USER = '/cgi-bin/tag/addtagusers';
    const TAG_DEL_USER = '/cgi-bin/tag/deltagusers';
    const TAG_LIST = '/cgi-bin/tag/list';

    /**
     * 创建标签.
     *
     * @param array $data
     *
     * {
     * "tagname": "UI",
     * "tagid": 12
     * }
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function create($data)
    {
        return $this->http->response('JSON', [self::TAG_CREATE, $data]);
    }

    /**
     * 更新标签.
     *
     * @param array $data
     *
     * {
     * "tagid": 12,
     * "tagname": "UI design"
     * }
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function update($data)
    {
        return $this->http->response('JSON', [self::TAG_UPDATE, $data]);
    }

    /**
     * 删除标签.
     *
     * @param int $tagid 标签ID
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function delete($tagid)
    {
        return $this->http->response('GET', [self::TAG_DELETE, ['tagid' => $tagid]]);
    }

    /**
     * 获取标签成员.
     *
     * @param int $tagid 标签ID
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get($tagid)
    {
        return $this->http->response('GET', [self::TAG_GET, ['tagid' => $tagid]]);
    }

    /**
     * 增加标签成员.
     *
     * @param array $data
     *
     * {
     * "tagid": 12,
     * "userlist":[ "user1","user2"],
     * "partylist": [4]
     * }
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function addUsers($data)
    {
        return $this->http->response('JSON', [self::TAG_ADD_USER, $data]);
    }

    /**
     * 删除标签成员.
     *
     * @param array $data
     *
     * {
     * "tagid": 12,
     * "userlist":[ "user1","user2"],
     * "partylist":[2,4]
     * }
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function delUsers($data)
    {
        return $this->http->response('JSON', [self::TAG_DEL_USER, $data]);
    }

    /**
     * 获取标签列表.
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function lists()
    {
        return $this->http->response('GET', [self::TAG_LIST]);
    }
}
