# Access Token

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
/** @var \WeWork\ApiCache\Token $token */
$token = $app->get('token');
```

## 获取

```php
$token->get();
```

## 刷新

```php
$token->get(true);
```


