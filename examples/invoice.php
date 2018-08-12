<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Invoice $invoice */
$invoice = $app->get('invoice');

try {
    $invoice->getInfo('CARDID', 'ENCRYPTCODE');
} catch (Exception $e) {
}

try {
    $invoice->updateStatus('CARDID', 'ENCRYPTCODE', 'INVOICE_REIMBURSE_INIT');
} catch (Exception $e) {
}

try {
    $invoice->updateStatusBatch('OPENID', 'INVOICE_REIMBURSE_INIT', [
        ['card_id' => 'CARDID', 'encrypt_code' => 'ENCRYPTCODE']
    ]);
} catch (Exception $e) {
}

try {
    $invoice->getInfoBatch([
        ['card_id' => 'CARDID', 'encrypt_code' => 'ENCRYPTCODE']
    ]);
} catch (Exception $e) {
}

