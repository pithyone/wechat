<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Batch
{
    use HttpClientTrait;

    /**
     * 邀请成员
     *
     * @param array $json
     * @return array
     */
    public function invite(array $json): array
    {
        return $this->httpClient->postJson('batch/invite', $json);
    }

    /**
     * 增量更新成员
     *
     * @param array $json
     * @return array
     */
    public function syncUser(array $json): array
    {
        return $this->httpClient->postJson('batch/syncuser', $json);
    }

    /**
     * 全量覆盖成员
     *
     * @param array $json
     * @return array
     */
    public function replaceUser(array $json): array
    {
        return $this->httpClient->postJson('batch/replaceuser', $json);
    }

    /**
     * 全量覆盖部门
     *
     * @param array $json
     * @return array
     */
    public function replaceParty(array $json): array
    {
        return $this->httpClient->postJson('batch/replaceparty', $json);
    }

    /**
     * 获取异步任务结果
     *
     * @param string $jobId
     * @return array
     */
    public function getResult(string $jobId): array
    {
        return $this->httpClient->get('batch/getresult', ['jobid' => $jobId]);
    }
}
