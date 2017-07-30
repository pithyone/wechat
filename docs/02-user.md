# 成员管理

## 目录

- [获取实例](#获取实例)
- API接口
    - [创建成员](#创建成员)
    - [读取成员](#读取成员)
    - [更新成员](#更新成员)
    - [删除成员](#删除成员)
    - [批量删除成员](#批量删除成员)
    - [获取部门成员](#获取部门成员)
    - [获取部门成员详情](#获取部门成员详情)
    - [userid转换成openid](#userid转换成openid)
    - [openid转换成userid](#openid转换成userid)
    - [二次验证](#二次验证)
    
> 使用通讯录同步助手的secret进行开发

> 可直接参考 [demo](../examples/user.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$contacts = $work->setAgentId('contacts');

$user = $contacts->user;
```

## 创建成员

```php
$user->create($data);
```

## 读取成员

```php
$user->get($userid);
```

## 更新成员

```php
$user->update($data);
```

## 删除成员

```php
$user->delete($userid);
```

## 批量删除成员

```php
$user->batchDelete([$userid1, $userid2, $userid3]);
```

## 获取部门成员

```php
$user->simpleLists($department_id, $fetch_child);
```

## 获取部门成员详情

```php
$user->lists($department_id, $fetch_child);
```

## userid转换成openid

```php
$user->convertToOpenId($userid);
```

## openid转换成userid

```php
$user->convertToUserId($open_id);
```

## 二次验证

```php
$user->authSuccess($userid);
```

