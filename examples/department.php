<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Department $department */
$department = $app->get('department');

try {
    $department->create([
        'name' => '广州研发中心',
        'parentid' => 1,
        'order' => 1,
        'id' => 1024
    ]);
} catch (Exception $e) {
}

try {
    $department->update([
        'id' => 1024,
        'name' => '广州研发中心',
    ]);
} catch (Exception $e) {
}

try {
    $department->delete(1024);
} catch (Exception $e) {
}

try {
    $department->list();
} catch (Exception $e) {
}

try {
    $department->list(1);
} catch (Exception $e) {
}
