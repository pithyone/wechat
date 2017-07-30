# 自定义菜单

## 目录

- [获取实例](#获取实例)
- API接口
    - [创建菜单](#创建菜单)
    - [获取菜单](#获取菜单)
    - [删除菜单](#删除菜单)

> 可直接参考 [demo](../examples/menu.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$menu = $test->menu;
```

## 创建菜单

```php
$menu->create($data);
```

## 获取菜单

```php
$menu->get();
```

## 删除菜单

```php
$menu->delete();
```
