<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\ApiCache\JsApiTicket $jsApiTicket */
$jsApiTicket = $app->get('jsApiTicket');

try {
    $jsApiTicket->get();
} catch (\Psr\SimpleCache\InvalidArgumentException $e) {
}

try {
    $jsApiTicket->get(true);
} catch (\Psr\SimpleCache\InvalidArgumentException $e) {
}
