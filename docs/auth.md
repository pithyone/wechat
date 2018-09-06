# 网页授权登录

```php
$user = $app->get('user');
```

## 根据code获取成员信息

```php
$user->getInfo('CODE');
```

## 使用user_ticket获取成员详情

```php
$user->getDetail('USER_TICKET');
```
