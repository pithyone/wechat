# 打卡管理

```php
$checkIn = $app->get('checkIn');
```

## 获取打卡规则

```php
$checkIn->getOption(1511971200, ['james', 'paul']);
```

## 获取打卡数据

```php
$checkIn->getData(\WeWork\Api\CheckIn::TYPE_ALL, 1492617600, 1492790400, ['james', 'paul']);
```
