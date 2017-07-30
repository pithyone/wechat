<?php

require __DIR__ . '/../vendor/autoload.php';

use pithyone\wechat\Work;

spl_autoload_register(function ($c) {
    @include_once strtr($c, '\\_', '//') . '.php';
});
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__DIR__) . '/src');

$config = [
    'debug'    => true,
    'log'      => [
        'file' => __DIR__ . '/../tmp/work-wechat.log'
    ],
    'corp_id'  => 'your-corp-id',
    'contacts' => [
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret'
    ],
    'test'     => [
        'agent_id' => 'your-test-agent-id',
        'token'    => 'your-test-agent-token',
        'aes_key'  => 'your-test-agent-aes-key',
        'secret'   => 'your-test-agent-secret'
    ]
];

$work = new Work($config);

$test = $work->setAgentId('test');
$agent = $test->agent;

// 获取应用
$agent->get();

// 设置应用
$agent->set([
    "report_location_flag" => 0,
    "logo_mediaid"         => "1yCUUjms50ItlZvMwYaqswc4sOL8YHYYSE3ZFXLl87JcM9AjCsQ0Au7Z15hVXnsM6",
    "name"                 => "NAME",
    "description"          => "DESC",
    "redirect_domain"      => "xxxxxx",
    "isreportenter"        => 0,
    "home_url"             => "http://www.qq.com"
]);

// 获取应用概况列表
$agent->lists();