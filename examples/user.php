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
$user = $contacts->user;

// 创建成员
$user->create([
    'userid'         => 'zhangsan',
    'name'           => '张三',
    'english_name'   => 'jackzhang',
    'mobile'         => '15913215421',
    'department'     => [110, 17],
    'order'          => [10, 40],
    'position'       => '后台工程师',
    'gender'         => '1',
    'email'          => 'zhangsan2@gzdev.com',
    'isleader'       => 1,
    'enable'         => 1,
    'avatar_mediaid' => '1enMf334sxI-VWCQiscqrfg44h9zIz-5bXEzs5HujYVU',
    'telephone'      => '020-123456',
    'extattr'        => [
        'attrs' => [
            [
                'name'  => '爱好',
                'value' => '旅游',
            ],
            [
                'name'  => '卡号',
                'value' => '1234567234',
            ],
        ],
    ],
]);

// 读取成员
$user->get('zhangsan');

// 更新成员
$user->update([
    'userid'         => 'zhangsan',
    'name'           => '李四',
    'english_name'   => 'jackzhang',
    'mobile'         => '15913215421',
    'department'     => [110],
    'order'          => [10],
    'position'       => '后台工程师',
    'gender'         => '1',
    'email'          => 'zhangsan2@gzdev.com',
    'isleader'       => 1,
    'enable'         => 0,
    'avatar_mediaid' => '1enMf334sxI-VWCQiscqrfg44h9zIz-5bXEzs5HujYVU',
    'telephone'      => '020-123456',
    'extattr'        => [
        'attrs' => [
            [
                'name'  => '爱好',
                'value' => '旅游',
            ],
            [
                'name'  => '卡号',
                'value' => '1234567234',
            ],
        ],
    ],
]);

// 删除成员
$user->delete('zhangsan');

// 批量删除成员
$user->batchDelete(['zhangsan']);

// 获取部门成员
$user->simpleLists(16, 0);

// 获取部门成员详情
$user->lists(16, 0);

// userid转换成openid接口
$user->convertToOpenId('wb');

// openid转换成userid接口
$user->convertToUserId('ohgbiw8bMPSx6gTk-ICzcmitRL_0');

// 二次验证
$user->authSuccess('zhangsan');
