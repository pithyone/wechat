<?php
/**
 * token.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$test = $work->setAgentId('test');
$token = $test->token;

// 获取 test 应用 access_token
//var_dump($token->get());

// 强制刷新并获取access_token
//var_dump($token->get(true));

$contacts = $work->setAgentId('contacts');
$token = $contacts->token;

// 获取 contacts 应用 access_token
//var_dump($token->get());
