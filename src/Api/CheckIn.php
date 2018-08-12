<?php

namespace WeWork\Api;

use WeWork\Traits\HttpClientTrait;

class CheckIn
{
    use HttpClientTrait;

    const TYPE_COMMUTE = 1;
    const TYPE_OUTSIDE = 2;
    const TYPE_ALL = 3;

    /**
     * 获取打卡规则
     *
     * @param int $datetime
     * @param array $userIdList
     * @return array
     */
    public function getOption(int $datetime, array $userIdList): array
    {
        return $this->httpClient->postJson('checkin/getcheckinoption', ['datetime' => $datetime, 'useridlist' => $userIdList]);
    }

    /**
     * 获取打卡数据
     *
     * @param int $type
     * @param int $startTime
     * @param int $endTime
     * @param array $userIdList
     * @return array
     */
    public function getData(int $type, int $startTime, int $endTime, array $userIdList): array
    {
        return $this->httpClient->postJson('checkin/getcheckindata', [
            'opencheckindatatype' => $type,
            'starttime' => $startTime,
            'endtime' => $endTime,
            'useridlist' => $userIdList
        ]);
    }
}
