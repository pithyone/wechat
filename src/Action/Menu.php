<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Core\Http;

class Menu extends Base
{
    const MENU_CREATE = '/cgi-bin/menu/create';
    const MENU_GET = '/cgi-bin/menu/get';
    const MENU_DELETE = '/cgi-bin/menu/delete';

    /**
     * Menu constructor.
     *
     * @param Http   $http
     * @param string $agentId 企业应用的id
     */
    public function __construct(Http $http, $agentId)
    {
        parent::__construct($http);

        $http->addQuery(['agentid' => $agentId]);
    }

    /**
     * 创建应用菜单.
     *
     * @param array $data
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::MENU_CREATE, $data]);
    }

    /**
     * 获取菜单列表.
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get()
    {
        return $this->http->response('GET', [self::MENU_GET]);
    }

    /**
     * 删除应用菜单.
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function delete()
    {
        return $this->http->response('GET', [self::MENU_DELETE]);
    }
}
