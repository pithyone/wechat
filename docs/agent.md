# 应用管理

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '应用密钥',
    'agent_id' => 应用ID,
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
/** @var \WeWork\Api\Agent $agent */
$agent = $app->get('agent');
```

## 获取应用

```php
$agent->get();
```

## 设置应用

```php
$agent->set([
    'close' => 0
]);
```

## 获取应用列表

```php
$agent->list();
```
