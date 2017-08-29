<?php

namespace pithyone\wechat\Action;

use Doctrine\Common\Cache\CacheProvider;
use pithyone\wechat\Core\Http;
use pithyone\wechat\Exceptions\HttpException;

class Token
{
    /**
     * @var string
     */
    protected $corpId;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $agentId;

    /**
     * @var CacheProvider
     */
    protected $cache;

    /**
     * @var string
     */
    protected $cacheId;

    const GET_TOKEN = '/cgi-bin/gettoken';

    /**
     * Token constructor.
     *
     * @param string        $corpId
     * @param string        $secret
     * @param string        $agentId
     * @param CacheProvider $cache
     */
    public function __construct($corpId, $secret, $agentId, CacheProvider $cache)
    {
        $this->corpId = $corpId;
        $this->secret = $secret;
        $this->agentId = $agentId;
        $this->cache = $cache;
        $this->cacheId = "work_wechat.access_token.{$this->corpId}.{$this->agentId}";
    }

    /**
     * @param bool $forceRefresh
     *
     * @return false|mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function get($forceRefresh = false)
    {
        $access_token = $this->cache->fetch($this->cacheId);

        if ($forceRefresh || empty($access_token)) {
            $token = $this->getFromServer();
            $access_token = $token['access_token'];
            $this->cache->save($this->cacheId, $access_token, $token['expires_in'] - 1500);
        }

        return $access_token;
    }

    /**
     * @throws HttpException
     *
     * @return mixed
     *
     * @author wangbing <pithyone@vip.qq.com>
     */
    protected function getFromServer()
    {
        $http = new Http();
        $response = $http->response('GET', [self::GET_TOKEN, ['corpid' => $this->corpId, 'corpsecret' => $this->secret]]);

        if (!isset($response['access_token']) || empty($response['access_token'])) {
            throw new HttpException('get access token error');
        }

        return $response;
    }
}
