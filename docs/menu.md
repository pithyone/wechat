# 自定义菜单

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
/** @var \WeWork\Api\Menu $menu */
$menu = $app->get('menu');
```

## 创建菜单

```php
$menu->create([
    'button' => [
        [
            'type' => 'click',
            'name' => '今日歌曲',
            'key' => 'V1001_TODAY_MUSIC'
        ]
    ]
]);
```

## 获取菜单

```php
$menu->get();
```

## 删除菜单

```php
$menu->delete();
```
