<?php
/**
 * department.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$contacts = $work->setAgentId('contacts');
$department = $contacts->department;

// 创建部门
//var_dump($department->create([
//    'name'     => '深圳研发中心',
//    'parentid' => 1,
//    'order'    => 100,
//]));

// 更新部门
//var_dump($department->update([
//    'id'       => 37,
//    'name'     => '广州研发中心',
//    'parentid' => 1,
//    'order'    => 1,
//]));

// 删除部门
//var_dump($department->delete(37));

// 获取部门列表
//var_dump($department->lists(37));
