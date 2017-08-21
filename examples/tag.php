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
$tag = $contacts->tag;

// 创建标签
$tag->create(['tagname' => 'UI']);

// 更新标签
$tag->update([
    'tagid'   => 11,
    'tagname' => 'UI design',
]);

// 删除标签
$tag->delete(11);

// 获取标签成员
$tag->get(11);

// 增加标签成员
$tag->addUsers([
    'tagid'     => 11,
    'userlist'  => ['wb'],
    'partylist' => [1],
]);

// 删除标签成员
$tag->delUsers([
    'tagid'     => 11,
    'partylist' => [1],
]);

// 获取标签列表
$tag->lists();
