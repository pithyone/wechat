# 标签管理

```php
$tag = $app->get('tag');
```

## 创建标签

```php
$tag->create('UI', 1024);
```

## 更新标签名字

```php
$tag->update(1024, 'UI design');
```

## 删除标签

```php
$tag->delete(1024);
```

## 获取标签成员

```php
$tag->get(1024);
```

## 增加标签成员

```php
$tag->addUsers(['tagid' => 1024, 'userlist' => ['user1', 'user2']]);
```

## 删除标签成员

```php
$tag->delUsers(['tagid' => 1024, 'userlist' => ['user1', 'user2']]);
```

## 获取标签列表

```php
$tag->list();
```
