# 获取审批数据

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '审批应用密钥',
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
/** @var \WeWork\Api\Corp $corp */
$corp = $app->get('corp');
```

```php
$corp->getApprovalData(1492617600, 1492790400, 201704200003);
```
