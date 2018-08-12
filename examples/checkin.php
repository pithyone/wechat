<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\CheckIn $checkIn */
$checkIn = $app->get('checkIn');

try {
    $checkIn->getOption(1511971200, ['james', 'paul']);
} catch (Exception $e) {
}

try {
    $checkIn->getData(\WeWork\Api\CheckIn::TYPE_ALL, 1492617600, 1492790400, ['james', 'paul']);
} catch (Exception $e) {
}
