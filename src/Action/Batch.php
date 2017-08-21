<?php

namespace pithyone\wechat\Action;

/**
 * Class Batch.
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
    public function syncUser($data)
    {
        return $this->http->response('JSON', [self::BATCH_SYNC_USER, $data]);
    }

    /**
     * �
     * �量覆盖成员.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function replaceUser($data)
    {
        return $this->http->response('JSON', [self::BATCH_REPLACE_USER, $data]);
    }

    /**
     * �
     * �量覆盖部门.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function replaceParty($data)
    {
        return $this->http->response('JSON', [self::BATCH_REPLACE_PARTY, $data]);
    }

    /**
     * 获取异步任务结果.
     *
     * @param string $jobid 异步任务id
     *
     * @return mixed
     */
    public function result($jobid)
    {
        return $this->http->response('GET', [self::BATCH_GET_RESULT, ['jobid' => $jobid]]);
    }
}
