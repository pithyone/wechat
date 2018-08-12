<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class Corp
{
    use HttpClientTrait;

    /**
     * 获取审批数据
     *
     * @param int $startTime
     * @param int $endTime
     * @param int $nextSPNum
     * @return array
     */
    public function getApprovalData(int $startTime, int $endTime, int $nextSPNum = 0): array
    {
        $json = [
            'starttime' => $startTime,
            'endtime' => $endTime
        ];

        if ($nextSPNum > 0) {
            $json['next_spnum'] = $nextSPNum;
        }

        return $this->httpClient->postJson('corp/getapprovaldata', $json);
    }
}
