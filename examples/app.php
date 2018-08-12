<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \WeWork\App([
    'corp_id' => '',
    'secret' => '',
    'agent_id' => 0,
    'token' => '',
    'aes_key' => '',
    'cache' => [
        'path' => __DIR__ . '/cache'
    ],
    'logging' => [
        'path' => __DIR__ . '/log/app.log',
        'level' => 'debug'
    ]
]);

return $app;
