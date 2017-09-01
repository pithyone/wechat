<?php
/**
 * agent.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$test = $work->setAgentId('test');
$agent = $test->agent;

// 获取应用
//var_dump($agent->get());

// 设置应用
//var_dump($agent->set([
//    'report_location_flag' => 0,
//    'logo_mediaid'         => '1yCUUjms50ItlZvMwYaqswc4sOL8YHYYSE3ZFXLl87JcM9AjCsQ0Au7Z15hVXnsM6',
//    'name'                 => 'NAME',
//    'description'          => 'DESC',
//    'redirect_domain'      => 'xxxxxx',
//    'isreportenter'        => 0,
//    'home_url'             => 'http://www.qq.com',
//]));

// 获取应用概况列表
//var_dump($agent->lists());
