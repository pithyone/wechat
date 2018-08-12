<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\User $user */
$user = $app->get('user');

try {
    $user->create([
        'userid' => 'zhangsan',
        'name' => '张三',
        'department' => [1],
        'email' => 'zhangsan@gzdev.com'
    ]);
} catch (Exception $e) {
}

try {
    $user->get('zhangsan');
} catch (Exception $e) {
}

try {
    $user->update([
        'userid' => 'zhangsan',
        'name' => '张三三'
    ]);
} catch (Exception $e) {
}

try {
    $user->delete('zhangsan');
} catch (Exception $e) {
}

try {
    $user->batchDelete(['zhangsan', 'lisi']);
} catch (Exception $e) {
}

try {
    $user->list(1);
} catch (Exception $e) {
}

try {
    $user->list(1, true, true);
} catch (Exception $e) {
}

try {
    $user->convertIdToOpenid('zhangsan');
} catch (Exception $e) {
}

try {
    $user->convertOpenidToUserId('oDOGms-6yCnGrRovBj2yHij5JL6E');
} catch (Exception $e) {
}

try {
    $user->authSuccess('zhangsan');
} catch (Exception $e) {
}

try {
    $user->getInfo('CODE');
} catch (Exception $e) {
}

try {
    $user->getDetail('USER_TICKET');
} catch (Exception $e) {
}
