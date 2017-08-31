<?php

namespace pithyone\wechat\Action;

/**
 * Class Tag.
 */
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
     * @link https://work.weixin.qq.com/api/doc#10915
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::TAG_CREATE, $data]);
    }

    /**
     * 更新标签.
     *
     * @link https://work.weixin.qq.com/api/doc#10919
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update(array $data)
    {
        return $this->http->response('JSON', [self::TAG_UPDATE, $data]);
    }

    /**
     * 删除标签.
     *
     * @link https://work.weixin.qq.com/api/doc#10920
     *
     * @param int $tagId 标签ID
     *
     * @return mixed
     */
    public function delete($tagId)
    {
        return $this->http->response('GET', [self::TAG_DELETE, ['tagid' => $tagId]]);
    }

    /**
     * 获取标签成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10921
     *
     * @param int $tagId 标签ID
     *
     * @return mixed
     */
    public function get($tagId)
    {
        return $this->http->response('GET', [self::TAG_GET, ['tagid' => $tagId]]);
    }

    /**
     * 增加标签成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10923
     *
     * @param array $data
     *
     * @return mixed
     */
    public function addUsers(array $data)
    {
        return $this->http->response('JSON', [self::TAG_ADD_USER, $data]);
    }

    /**
     * 删除标签成员.
     *
     * @link https://work.weixin.qq.com/api/doc#10925
     *
     * @param array $data
     *
     * @return mixed
     */
    public function delUsers(array $data)
    {
        return $this->http->response('JSON', [self::TAG_DEL_USER, $data]);
    }

    /**
     * 获取标签列表.
     *
     * @link https://work.weixin.qq.com/api/doc#10926
     *
     * @return mixed
     */
    public function lists()
    {
        return $this->http->response('GET', [self::TAG_LIST]);
    }
}
