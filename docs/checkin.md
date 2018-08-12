# 打卡管理

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '打卡应用密钥',
    'cache' => [
        'path' => __DIR__ . '/cache'
    ],
    'logging' => [
        'path' => __DIR__ . '/log/app.log',
        'level' => 'debug'
    ]
]);
```

```php
/** @var \WeWork\Api\CheckIn $checkIn */
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


