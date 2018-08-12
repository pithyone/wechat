# 成员管理

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
/** @var \WeWork\Api\User $user */
$user = $app->get('user');
```

## 创建成员

```php
$user->create([
    'userid' => 'zhangsan',
    'name' => '张三',
    'department' => [1],
    'email' => 'zhangsan@gzdev.com'
]);
```

## 读取成员

```php
$user->get('zhangsan');
```

## 更新成员

```php
$user->update([
    'userid' => 'zhangsan',
    'name' => '张三三'
]);
```

## 删除成员

```php
$user->delete('zhangsan');
```

## 批量删除成员

```php
$user->batchDelete(['zhangsan', 'lisi']);
```

## 获取部门成员

```php
$user->list(1);
```

## 获取部门成员详情

```php
$user->list(1, true, true);
```

## userid转openid

```php
$user->convertIdToOpenid('zhangsan');
```

## openid转userid

```php
$user->convertOpenidToUserId('oDOGms-6yCnGrRovBj2yHij5JL6E');
```

## 二次验证

```php
$user->authSuccess('zhangsan');
```

## 根据code获取成员信息

```php
$user->getInfo('CODE');
```

## 使用user_ticket获取成员详情

```php
$user->getDetail('USER_TICKET');
```
