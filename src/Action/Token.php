<?php

namespace pithyone\wechat\Action;

use Doctrine\Common\Cache\CacheProvider;
use pithyone\wechat\Util\Http;
use pithyone\wechat\Exception\HttpException;

/**
 * Class Token.
 */
class Token extends Base
{
    const GET_TOKEN = '/cgi-bin/gettoken';

    /**
     * @var string
     */
    protected $corpId;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var CacheProvider
     */
    protected $cache;

    /**
     * @var string
     */
    protected $cacheId;

    /**
     * Token constructor.
     *
     * @param string        $corpId
     * @param string        $secret
     * @param string        $agentId
     * @param Http          $http
     * @param CacheProvider $cache
     */
    public function __construct($corpId, $secret, $agentId, Http $http, CacheProvider $cache)
    {
        parent::__construct($http);
        $this->corpId = $corpId;
        $this->secret = $secret;
        $this->cache = $cache;
        $this->cacheId = "work_wechat.access_token.{$this->corpId}.{$agentId}";
    }

    /**
     * 获取access_token
     *
     * @param bool $forceRefresh 是否删除缓存重新获取
     *
     * @return mixed
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
     * @link https://work.weixin.qq.com/api/doc#10013
     *
     * @throws HttpException
     *
     * @return mixed
     */
    protected function getFromServer()
    {
        $response = $this->http->response(
            'GET',
            [self::GET_TOKEN, ['corpid' => $this->corpId, 'corpsecret' => $this->secret]]
        );

        if (!isset($response['access_token']) || empty($response['access_token'])) {
            throw new HttpException('get access token error');
        }

        return $response;
    }
}
