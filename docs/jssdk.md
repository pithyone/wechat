# JS-SDK

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '应用密钥',
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
/** @var \WeWork\JSSdk $jssdk */
$jssdk = $app->get('jssdk');
```

## 发票签名

```php
$jssdk->getChooseInvoiceConfig();
```

## 权限验证配置

```php
$jssdk->getConfig('URL');
```
