# 自定义菜单

```php
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
