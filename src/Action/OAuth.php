<?php

namespace pithyone\wechat\Action;

/**
 * Class OAuth.
 *
 * @link https://work.weixin.qq.com/api/doc#10028
 */
class OAuth extends Base
{
    const GET_USER_INFO = '/cgi-bin/user/getuserinfo';
    const GET_USER_DETAIL = '/cgi-bin/user/getuserdetail';

    /**
     * 根据code获取成员信息.
     *
     * @param string $code 通过成员授权获取到的code，每次成员授权带上的code将不一样，code只能使用一次，10分钟未被使用自动过期
     *
     * @return mixed
     */
    public function getUserInfo($code)
    {
        return $this->http->response('GET', [self::GET_USER_INFO, ['code' => $code]]);
    }

    /**
     * 使用user_ticket获取成员详情.
     *
     * @param string $userTicket 成员票据
     *
     * @return mixed
     */
    public function getUserDetail($userTicket)
    {
        return $this->http->response('JSON', [self::GET_USER_DETAIL, ['user_ticket' => $userTicket]]);
    }
}
