<?php

namespace pithyone\wechat\Action;

/**
 * Class Department.
 */
class Department extends Base
{
    const DEPARTMENT_CREATE = '/cgi-bin/department/create';
    const DEPARTMENT_UPDATE = '/cgi-bin/department/update';
    const DEPARTMENT_DELETE = '/cgi-bin/department/delete';
    const DEPARTMENT_LIST = '/cgi-bin/department/list';

    /**
     * 创建部门.
     *
     * @link https://work.weixin.qq.com/api/doc#10076
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::DEPARTMENT_CREATE, $data]);
    }

    /**
     * 更新部门.
     *
     * @link https://work.weixin.qq.com/api/doc#10077
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update(array $data)
    {
        return $this->http->response('JSON', [self::DEPARTMENT_UPDATE, $data]);
    }

    /**
     * 删除部门.
     *
     * @link https://work.weixin.qq.com/api/doc#10079
     *
     * @param int $id 部门id。（注：不能删除根部门；不能删除含有子部门、成员的部门）
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->http->response('GET', [self::DEPARTMENT_DELETE, ['id' => $id]]);
    }

    /**
     * 获取部门列表.
     *
     * @link https://work.weixin.qq.com/api/doc#10093
     *
     * @param int $id 部门id。获取指定部门及其下的子部门。 如果不填，默认获取全量组织架构
     *
     * @return mixed
     */
    public function lists($id = null)
    {
        $query = [];
        !is_null($id) && $query['id'] = $id;

        return $this->http->response('GET', [self::DEPARTMENT_LIST, $query]);
    }
}
