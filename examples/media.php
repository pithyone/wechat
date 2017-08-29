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

$test = $work->setAgentId('test');
$media = $test->media;

// 上传临时素材文件
$media->upload('image', '/Users/wb/Documents/Public/Robot_Emoji_Icon.png');

// 获取临时素材文件
file_put_contents(__DIR__.'/../tmp/image.png', $media->get('3A-Me_ZkxJPO3W6Z-7JkBuRtoq9E7pYdDkWEBFdORcbgmKY1DHlHYg4My3C-8TXYy'));
