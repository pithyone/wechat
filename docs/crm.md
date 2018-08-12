# 获取外部联系人详情

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '外部联系人密钥',
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
/** @var \WeWork\Api\CRM $crm */
$crm = $app->get('crm');
```

```php
$crm->getExternalContact('EXTERNAL_USERID');
```
