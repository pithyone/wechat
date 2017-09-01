<?php
/**
 * corp.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$chart = $work->setAgentId('chart');
$corp = $chart->corp;

// 获取打卡数据
$data = [
    'opencheckindatatype' => 3,
    'starttime'           => 1492617600,
    'endtime'             => 1492790400,
    'useridlist'          => ['wb'],
];
//var_dump($corp->getCheckInData($data));

$approval = $work->setAgentId('approval');
$corp = $approval->corp;

// 获取打卡数据
$data = [
    'starttime'  => 1492617600,
    'endtime'    => 1492790400,
    'next_spnum' => 201704200003,
];
//var_dump($corp->getApprovalData($data));
