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
$menu = $test->menu;

// 创建菜单
$menu->create([
    'button' => [
        [
            'name'       => '扫码',
            'sub_button' => [
                [
                    'type'       => 'scancode_waitmsg',
                    'name'       => '扫码带提示',
                    'key'        => 'rselfmenu_0_0',
                    'sub_button' => [],
                ],
                [
                    'type'       => 'scancode_push',
                    'name'       => '扫码推事件',
                    'key'        => 'rselfmenu_0_1',
                    'sub_button' => [],
                ],
            ],
        ],
        [
            'name'       => '发图',
            'sub_button' => [

                [
                    'type'       => 'pic_sysphoto',
                    'name'       => '系统拍照发图',
                    'key'        => 'rselfmenu_1_0',
                    'sub_button' => [],
                ],
                [
                    'type'       => 'pic_photo_or_album',
                    'name'       => '拍照或者相册发图',
                    'key'        => 'rselfmenu_1_1',
                    'sub_button' => [],
                ],
                [
                    'type'       => 'pic_weixin',
                    'name'       => '微信相册发图',
                    'key'        => 'rselfmenu_1_2',
                    'sub_button' => [],
                ],
            ],
        ],
        [
            'name'       => '其他',
            'sub_button' => [
                [
                    'type' => 'view',
                    'name' => '搜索',
                    'url'  => 'http://www.soso.com',
                ],
                [
                    'type' => 'click',
                    'name' => '赞一下我们',
                    'key'  => 'V1001_GOOD',
                ],
                [
                    'name' => '发送位置',
                    'type' => 'location_select',
                    'key'  => 'rselfmenu_2_0',
                ],
            ],
        ],
    ],
]);

// 获取菜单
$menu->get();

// 删除菜单
$menu->delete();
