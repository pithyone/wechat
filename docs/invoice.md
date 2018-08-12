# 电子发票

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
/** @var \WeWork\Api\Invoice $invoice */
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
