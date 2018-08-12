# 部门管理

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '通讯录同步应用密钥',
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
/** @var \WeWork\Api\Department $department */
$department = $app->get('department');
```

## 创建部门

```php
$department->create([
    'name' => '广州研发中心',
    'parentid' => 1,
    'order' => 1,
    'id' => 1024
]);
```

## 更新部门

```php
$department->update([
    'id' => 1024,
    'name' => '广州研发中心',
]);
```

## 删除部门

```php
$department->delete(1024);
```

## 获取部门列表

```php
$department->list();
```
