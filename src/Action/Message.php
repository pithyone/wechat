<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Core\Http;
use pithyone\wechat\Message\AttributeInterface;

/**
 * Class Message
 *
 * @method $this touser(array $touser)
 * @method $this toparty(array $toparty)
 * @method $this totag(array $totag)
 * @method $this safe($safe = 0)
 */
class Message extends Base
{
    const MESSAGE_SEND = '/cgi-bin/message/send';

    /**
     * @var array
     */
    protected $data;

    /**
     * Message constructor.
     *
     * @param Http   $http
     * @param string $agentId
     */
    public function __construct(Http $http, $agentId)
    {
        parent::__construct($http);

        $this->data['agentid'] = $agentId;
    }

    /**
     * 发消息
     *
     * @param AttributeInterface $handler
     *
     * @return mixed
     */
    public function send(AttributeInterface $handler)
    {
        $this->data = array_merge($this->data, $handler->get());

        return $this->http->response('JSON', [self::MESSAGE_SEND, $this->data]);
    }

    /**
     * @param $method
     * @param $args
     *
     * @return $this
     */
    public function __call($method, $args)
    {
        $data = $args[0];
        if (in_array($method, ['touser', 'toparty', 'totag']) && is_array($data)) {
            $data = implode('|', $data);
        }

        $this->data[$method] = $data;

        return $this;
    }
}
