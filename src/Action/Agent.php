<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Util\Http;

/**
 * Class Agent.
 */
class Agent extends Base
{
    const AGENT_GET = '/cgi-bin/agent/get';
    const AGENT_SET = '/cgi-bin/agent/set';
    const AGENT_LIST = '/cgi-bin/agent/list';

    /**
     * @var string
     */
    protected $agentId;

    /**
     * Agent constructor.
     *
     * @param Http   $http
     * @param string $agentId 应用id
     */
    public function __construct(Http $http, $agentId)
    {
        parent::__construct($http);
        $this->agentId = $agentId;
    }

    /**
     * 获取应用.
     *
     * @link https://work.weixin.qq.com/api/doc#10087
     *
     * @return mixed
     */
    public function get()
    {
        return $this->http->response('GET', [self::AGENT_GET, ['agentid' => $this->agentId]]);
    }

    /**
     * 设置应用.
     *
     * @link https://work.weixin.qq.com/api/doc#10088
     *
     * @param array $data
     *
     * @return mixed
     */
    public function set(array $data)
    {
        $data['agentid'] = $this->agentId;

        return $this->http->response('JSON', [self::AGENT_SET, $data]);
    }

    /**
     * 获取应用概况列表.
     *
     * @link https://work.weixin.qq.com/api/doc#11214
     *
     * @return mixed
     */
    public function lists()
    {
        return $this->http->response('GET', [self::AGENT_LIST]);
    }
}
