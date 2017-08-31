<?php

namespace pithyone\wechat\Action;

/**
 * Class Batch.
 *
 * @link https://work.weixin.qq.com/api/doc#10138
 */
class Batch extends Base
{
    const BATCH_SYNC_USER = '/cgi-bin/batch/syncuser';
    const BATCH_REPLACE_USER = '/cgi-bin/batch/replaceuser';
    const BATCH_REPLACE_PARTY = '/cgi-bin/batch/replaceparty';
    const BATCH_GET_RESULT = '/cgi-bin/batch/getresult';

    /**
     * 增量更新成员.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function syncUser(array $data)
    {
        return $this->http->response('JSON', [self::BATCH_SYNC_USER, $data]);
    }

    /**
     * 全量覆盖成员.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function replaceUser(array $data)
    {
        return $this->http->response('JSON', [self::BATCH_REPLACE_USER, $data]);
    }

    /**
     * 全量覆盖部门.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function replaceParty(array $data)
    {
        return $this->http->response('JSON', [self::BATCH_REPLACE_PARTY, $data]);
    }

    /**
     * 获取异步任务结果.
     *
     * @param string $jobId 异步任务id
     *
     * @return mixed
     */
    public function result($jobId)
    {
        return $this->http->response('GET', [self::BATCH_GET_RESULT, ['jobid' => $jobId]]);
    }
}
