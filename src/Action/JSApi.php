<?php

namespace pithyone\wechat\Action;

use Doctrine\Common\Cache\CacheProvider;
use pithyone\wechat\Core\Http;
use pithyone\wechat\Exceptions\HttpException;

/**
 * Class JSApi.
 */
class JSApi extends Base
{
    const GET_TICKET = '/cgi-bin/get_jsapi_ticket';

    /**
     * @var CacheProvider
     */
    protected $cache;

    /**
     * @var string
     */
    protected $corpId;

    /**
     * JSApi constructor.
     *
     * @param Http          $http
     * @param CacheProvider $cache
     * @param string        $corpId
     */
    public function __construct(Http $http, CacheProvider $cache, $corpId)
    {
        parent::__construct($http);

        $this->corpId = $corpId;
        $this->cache = $cache;
    }

    /**
     * 获取企业微信JS接口临时票据
     *
     * @return mixed 临时票据字符串
     */
    public function getTicket()
    {
        $cache_id = "work_wechat.jsapi.ticket.{$this->corpId}";

        $ticket = $this->cache->fetch($cache_id);

        if (empty($ticket)) {
            $response = $this->getTicketFromServer();
            $ticket = $response['ticket'];
            $this->cache->save($cache_id, $ticket, $response['expires_in'] - 1500);
        }

        return $ticket;
    }

    /**
     * 获取企业微信JS接口临时票据
     *
     * @return array 临时票据字符串和过期时间数组
     */
    public function getTicketArray()
    {
        $cache_id = "work_wechat.jsapi.ticket.array.{$this->corpId}";

        $data = $this->cache->fetch($cache_id);

        if (empty($data)) {
            $response = $this->getTicketFromServer();
            $ticket = $response['ticket'];
            $expires_in = $response['expires_in'] - 500;
            $data = ['ticket' => $ticket, 'time' => time(), 'expire' => $expires_in];
            $this->cache->save($cache_id, $data, $expires_in);
        }

        return ['ticket' => $data['ticket'], 'invalid' => $data['expire'] - (time() - $data['time'])];
    }

    /**
     * @return mixed
     * @throws HttpException
     */
    protected function getTicketFromServer()
    {
        $response = $this->http->response('GET', [self::GET_TICKET]);

        if (!isset($response['ticket']) || empty($response['ticket'])) {
            throw new HttpException('get jsapi ticket error');
        }

        return $response;
    }

    /**
     * @return array
     */
    public function sign()
    {
        $nonceStr = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'), 0, 16);

        $timestamp = time();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $ticket = $this->getTicket();
        $rawString = "jsapi_ticket={$ticket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";

        $signature = sha1($rawString);

        return [
            "appId"     => $this->corpId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $rawString,
        ];
    }
}
