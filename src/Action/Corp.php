<?php
/**
 * Corp.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */

namespace pithyone\wechat\Action;

/**
 * Class Corp.
 */
class Corp extends Base
{
    const CHECK_IN_GET_CHECK_IN_DATA = '/cgi-bin/checkin/getcheckindata';
    const CORP_GET_APPROVAL_DATA = '/cgi-bin/corp/getapprovaldata';

    /**
     * 获取打卡数据.
     *
     * @link https://work.weixin.qq.com/api/doc#11196
     *
     * @param array $data
     *
     * @return mixed
     */
    public function getCheckInData(array $data)
    {
        return $this->http->response('JSON', [self::CHECK_IN_GET_CHECK_IN_DATA, $data]);
    }

    /**
     * 获取审批数据.
     *
     * @link https://work.weixin.qq.com/api/doc#11228
     *
     * @param array $data
     *
     * @return mixed
     */
    public function getApprovalData(array $data)
    {
        return $this->http->response('JSON', [self::CORP_GET_APPROVAL_DATA, $data]);
    }
}
