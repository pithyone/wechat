# AccessToken

## 目录

- [获取实例](#获取实例)
- API接口
    - [获取AccessToken](#获取AccessToken)

> 可直接参考 [demo](../examples/token.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$token = $test->token;
```

## 获取AccessToken

```php
$token->get();
```
