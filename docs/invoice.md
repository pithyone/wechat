# 电子发票

```php
$invoice = $app->get('invoice');
```

## 查询电子发票

```php
$invoice->getInfo('CARDID', 'ENCRYPTCODE');
```

## 更新发票状态

```php
$invoice->updateStatus('CARDID', 'ENCRYPTCODE', 'INVOICE_REIMBURSE_INIT');
```

## 批量更新发票状态

```php
$invoice->updateStatusBatch('OPENID', 'INVOICE_REIMBURSE_INIT', [
    ['card_id' => 'CARDID', 'encrypt_code' => 'ENCRYPTCODE']
]);
```

## 批量查询电子发票

```php
$invoice->getInfoBatch([
    ['card_id' => 'CARDID', 'encrypt_code' => 'ENCRYPTCODE']
]);
```
