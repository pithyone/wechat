<?php

require __DIR__.'/../vendor/autoload.php';

use pithyone\wechat\Work;

spl_autoload_register(function ($c) {
    @include_once strtr($c, '\\_', '//').'.php';
});
set_include_path(get_include_path().PATH_SEPARATOR.dirname(__DIR__).'/src');

$config = [
    'debug'    => true,
    'log'      => [
        'file' => __DIR__.'/../tmp/work-wechat.log',
    ],
    'corp_id'  => 'your-corp-id',
    'contacts' => [
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret',
    ],
    'test'     => [
        'agent_id' => 'your-test-agent-id',
        'token'    => 'your-test-agent-token',
        'aes_key'  => 'your-test-agent-aes-key',
        'secret'   => 'your-test-agent-secret',
    ],
];

$work = new Work($config);

$contacts = $work->setAgentId('contacts');
$department = $contacts->department;

// 创建部门
$department->create([
    'name'     => '深圳研发中心',
    'parentid' => 1,
    'order'    => 100,
]);

// 更新部门
$department->update([
    'id'       => 167,
    'name'     => '广州研发中心',
    'parentid' => 1,
    'order'    => 1,
]);

// 删除部门
$department->delete(167);

// 获取部门列表
$department->lists(167);
