# jsapi_ticket

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
/** @var \WeWork\ApiCache\JsApiTicket $jsApiTicket */
$jsApiTicket = $app->get('jsApiTicket');
```

## 获取

```php
$jsApiTicket->get();
```


