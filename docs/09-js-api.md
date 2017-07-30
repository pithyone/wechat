# JS-API

## 目录

- [获取实例](#获取实例)
- API接口
    - [临时票据](#临时票据)
    - [签名](#签名)

> 可直接参考 [demo](../examples/js-api.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$JSApi = $test->JSApi;
```

## 临时票据

```php
$JSApi->getTicket();
```

## 签名

```php
$JSApi->sign();
```
