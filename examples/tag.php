<?php
/**
 * tag.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$contacts = $work->setAgentId('contacts');
$tag = $contacts->tag;

// 创建标签
//var_dump($tag->create(['tagname' => 'UI']));

// 更新标签
//var_dump($tag->update([
//    'tagid'   => 2,
//    'tagname' => 'UI design',
//]));

// 删除标签
//var_dump($tag->delete(2));

// 获取标签成员
//var_dump($tag->get(2));

// 增加标签成员
//var_dump($tag->addUsers([
//    'tagid'     => 2,
//    'userlist'  => ['wb'],
//    'partylist' => [1],
//]));

// 删除标签成员
//var_dump($tag->delUsers([
//    'tagid'     => 2,
//    'partylist' => [1],
//]));

// 获取标签列表
//var_dump($tag->lists());
