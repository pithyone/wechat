# 素材管理

## 目录

- [获取实例](#获取实例)
- API接口
    - [上传临时素材文件](#上传临时素材文件)
    - [获取临时素材文件](#获取临时素材文件)

> 可直接参考 [demo](../examples/media.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$media = $test->media;
```

## 上传临时素材文件

```php
$media->upload('image', $filepath);
```

## 获取临时素材文件

```php
$media->get($media_id);
```
