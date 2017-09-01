<?php
/**
 * js-api.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$test = $work->setAgentId('test');
$JSApi = $test->JSApi;

// 获取企业微信JS接口临时票据
//var_dump($JSApi->getTicket());

// 获取企业微信JS接口临时票据（数组格式）
//var_dump($JSApi->getTicketArray());

// JS-SDK 配置
//var_dump($JSApi->sign());
