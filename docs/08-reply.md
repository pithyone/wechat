# 被动回复消息

## 目录

- [获取实例](#获取实例)
- API接口
    - [回复文本消息](#回复文本消息)
    - [回复图片消息](#回复图片消息)
    - [回复语音消息](#回复语音消息)
    - [回复视频消息](#回复视频消息)
    - [回复图文消息](#回复图文消息)

> SDK自动验证URL，只需要输出`$server->reply()`

> 可直接参考 [demo](../examples/server.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');
$server = $test->server;

// ...

$server->reply();
```

## 回复文本消息

```php
$server->setText($content);
```

## 回复图片消息

```php
$server->setImage($mediaId);
```

## 回复语音消息

```php
$server->setVoice($mediaId);
```

## 回复视频消息

```php
$server->setVideo($mediaId, $title, $description);
```

## 回复图文消息

```php
$newsArticle = new NewsArticle();
$newsArticle->title = 'title';
$newsArticle->description = 'description';
$newsArticle->url = 'http://www.soso.com';
$newsArticle->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';

$newsArticle2 = new NewsArticle();
$newsArticle2->title = 'title2';
$newsArticle2->description = 'description2';
$newsArticle2->url = 'http://www.soso.com';
$newsArticle2->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';

$server->setNews([$newsArticle, $newsArticle2]);
```
