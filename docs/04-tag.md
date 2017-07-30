# 标签管理

## 目录

- [获取实例](#获取实例)
- API接口
    - [创建标签](#创建标签)
    - [更新标签](#更新标签)
    - [删除标签](#删除标签)
    - [获取标签成员](#获取标签成员)
    - [增加标签成员](#增加标签成员)
    - [删除标签成员](#删除标签成员)
    - [获取标签列表](#获取标签列表)
    
> 使用通讯录同步助手的secret进行开发

> 可直接参考 [demo](../examples/tag.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$contacts = $work->setAgentId('contacts');

$tag = $contacts->tag;
```

## 创建标签

```php
$tag->create($data);
```

## 更新标签

```php
$tag->update($data);
```

## 删除标签

```php
$tag->delete($tagid);
```

## 获取标签成员

```php
$tag->get($tagid);
```

## 增加标签成员

```php
$tag->addUsers($data);
```

## 删除标签成员

```php
$tag->delUsers($data);
```

## 获取标签列表

```php
$tag->lists();
```
