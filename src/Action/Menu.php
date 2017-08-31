<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Util\Http;

/**
 * Class Menu.
 */
class Menu extends Base
{
    const MENU_CREATE = '/cgi-bin/menu/create';
    const MENU_GET = '/cgi-bin/menu/get';
    const MENU_DELETE = '/cgi-bin/menu/delete';

    /**
     * Menu constructor.
     *
     * @param Http   $http
     * @param string $agentId 应用id
     */
    public function __construct(Http $http, $agentId)
    {
        parent::__construct($http);
        $http->addQuery(['agentid' => $agentId]);
    }

    /**
     * 创建菜单.
     *
     * @link https://work.weixin.qq.com/api/doc#10786
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->http->response('JSON', [self::MENU_CREATE, $data]);
    }

    /**
     * 获取菜单.
     *
     * @link https://work.weixin.qq.com/api/doc#10787
     *
     * @return mixed
     */
    public function get()
    {
        return $this->http->response('GET', [self::MENU_GET]);
    }

    /**
     * 删除菜单.
     *
     * @link https://work.weixin.qq.com/api/doc#10788
     *
     * @return mixed
     */
    public function delete()
    {
        return $this->http->response('GET', [self::MENU_DELETE]);
    }
}
