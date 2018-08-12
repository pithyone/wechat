<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Menu $menu */
$menu = $app->get('menu');

try {
    $menu->create([
        'button' => [
            [
                'type' => 'click',
                'name' => '今日歌曲',
                'key' => 'V1001_TODAY_MUSIC'
            ]
        ]
    ]);
} catch (Exception $e) {
}

try {
    $menu->get();
} catch (Exception $e) {
}

try {
    $menu->delete();
} catch (Exception $e) {
}
