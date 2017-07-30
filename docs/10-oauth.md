# 网页授权

## 目录

- [获取实例](#获取实例)
- API接口
    - [根据code获取成员信息](#根据code获取成员信息)
    - [使用user_ticket获取成员详情](#使用user_ticket获取成员详情)

> 可直接参考 [demo](../examples/oauth.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$OAuth = $test->OAuth;
```

## 根据code获取成员信息

```php
$OAuth->getUserInfo($code);
```

## 使用user_ticket获取成员详情

```php
$OAuth->getUserDetail($user_ticket);
```
