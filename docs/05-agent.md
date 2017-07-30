# 应用管理

## 目录

- [获取实例](#获取实例)
- API接口
    - [获取应用](#获取应用)
    - [设置应用](#设置应用)
    - [获取应用概况列表](#获取应用概况列表)

> 可直接参考 [demo](../examples/agent.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$agent = $test->agent;
```

## 获取应用

```php
$agent->get();
```

## 设置应用

```php
$agent->set($data);
```

## 获取应用概况列表

```php
$agent->lists();
```
