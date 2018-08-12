<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Corp $corp */
$corp = $app->get('corp');

try {
    $corp->getApprovalData(1492617600, 1492790400, 201704200003);
} catch (Exception $e) {
}
