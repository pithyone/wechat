# 部门管理

## 目录

- [获取实例](#获取实例)
- API接口
    - [创建部门](#创建部门)
    - [更新部门](#更新部门)
    - [删除部门](#删除部门)
    - [获取部门列表](#获取部门列表)
    
> 使用通讯录同步助手的secret进行开发

> 可直接参考 [demo](../examples/department.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$contacts = $work->setAgentId('contacts');

$department = $contacts->department;
```

## 创建部门

```php
$department->create($data);
```

## 更新部门

```php
$department->update($data);
```

## 删除部门

```php
$department->delete($id);
```

## 获取部门列表

```php
$department->lists($id);
```
