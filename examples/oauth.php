<?php
/**
 * oauth.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$test = $work->setAgentId('test');
$OAuth = $test->OAuth;

// 根据code获取成员信息
//var_dump($OAuth->getUserInfo($_GET['code']));

// 使用user_ticket获取成员详情
//var_dump($OAuth->getUserDetail('5S47G4Uczt5QBe8--mZsQAT1DavxuAOUYOTNSGNti6zuBUVsVmLc34rrJwsIE1T5n3WuK7fPhcZ7Tkn-eINAdw'));
