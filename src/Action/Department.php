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
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        return $this->http->response('JSON', [self::DEPARTMENT_CREATE, $data]);
    }

    /**
     * 更新部门.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update($data)
    {
        return $this->http->response('JSON', [self::DEPARTMENT_UPDATE, $data]);
    }

    /**
     * 删除部门.
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
     * @param int $id 部门id。获取指定部门及�
     * �下的子部门。 如果不填，默认获取�
     * �量组织架构
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
