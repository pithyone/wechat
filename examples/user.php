<?php
/**
 * user.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$contacts = $work->setAgentId('contacts');
$user = $contacts->user;

// 创建成员
//var_dump($user->create([
//    'userid'         => 'zhangsan1',
//    'name'           => '张三',
//    'english_name'   => 'jackzhang',
//    'mobile'         => '15913215421',
//    'department'     => [1],
//    'order'          => [10],
//    'position'       => '后台工程师',
//    'gender'         => '1',
//    'email'          => 'zhangsan2@gzdev.com',
//    'isleader'       => 1,
//    'enable'         => 1,
//    'avatar_mediaid' => '1enMf334sxI-VWCQiscqrfg44h9zIz-5bXEzs5HujYVU',
//    'telephone'      => '020-123456',
//    'extattr'        => [
//        'attrs' => [
//            [
//                'name'  => '爱好',
//                'value' => '旅游',
//            ],
//            [
//                'name'  => '卡号',
//                'value' => '1234567234',
//            ],
//        ],
//    ],
//]));

// 读取成员
//var_dump($user->get('zhangsan'));

// 更新成员
//var_dump($user->update([
//    'userid'         => 'zhangsan1',
//    'name'           => '李四',
//    'english_name'   => 'jackzhang',
//    'mobile'         => '15913215421',
//    'department'     => [110],
//    'order'          => [10],
//    'position'       => '软件工程师',
//    'gender'         => '1',
//    'email'          => 'zhangsan2@gzdev.com',
//    'isleader'       => 1,
//    'enable'         => 0,
//    'avatar_mediaid' => '1enMf334sxI-VWCQiscqrfg44h9zIz-5bXEzs5HujYVU',
//    'telephone'      => '020-123456',
//    'extattr'        => [
//        'attrs' => [
//            [
//                'name'  => '爱好',
//                'value' => '旅游',
//            ],
//            [
//                'name'  => '卡号',
//                'value' => '1234567234',
//            ],
//        ],
//    ],
//]));

// 删除成员
//var_dump($user->delete('zhangsan1'));

// 批量删除成员
//var_dump($user->batchDelete(['zhangsan1']));

// 获取部门成员
//var_dump($user->simpleLists(16, 0));

// 获取部门成员详情
//var_dump($user->lists(16, 0));

// userid转换成openid接口
//var_dump($user->convertToOpenId('wb'));

// openid转换成userid接口
//var_dump($user->convertToUserId('ohgbiw8bMPSx6gTk-ICzcmitRL_0'));

// 二次验证
//var_dump($user->authSuccess('zhangsan'));
