# JS-SDK

## 获取企业的jsapi_ticket

```php
$app->get('jsApiTicket')->get();
```

## 生成权限验证配置

```php
$app->get('jssdk')->getConfig('URL');
```

## 获取电子发票ticket

```php
$app->get('ticket')->get();
```

## 生成拉起电子发票列表配置

```php
$app->get('jssdk')->getChooseInvoiceConfig();
```
