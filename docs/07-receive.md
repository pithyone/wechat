# 接收消息

## 目录

- [获取实例](#获取实例)
- [获取属性值](#获取属性值)
- [获取属性数组值](#获取属性数组值)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$server = $test->server;
```

## 获取属性值

例如：获取文本消息内容

```php
$server->Content;
```

## 获取属性数组值

例如：获取弹出地理位置选择器的事件推送->地理位置的字符串信息

```php
$server->SendLocationInfo->Label;
$server->SendLocationInfo->get('Label');
$server->SendLocationInfo['Label'];
```
