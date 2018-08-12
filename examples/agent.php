<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Agent $agent */
$agent = $app->get('agent');

try {
    $agent->get();
} catch (Exception $e) {
}

try {
    $agent->set([
        'close' => 0
    ]);
} catch (Exception $e) {
}

try {
    $agent->list();
} catch (Exception $e) {
}
