<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Tag $tag */
$tag = $app->get('tag');

try {
    $tag->create('UI', 1024);
} catch (Exception $e) {
}

try {
    $tag->update(1024, 'UI design');
} catch (Exception $e) {
}

try {
    $tag->delete(1024);
} catch (Exception $e) {
}

try {
    $tag->get(1024);
} catch (Exception $e) {
}

try {
    $tag->addUsers(['tagid' => 1024, 'userlist' => ['user1', 'user2']]);
} catch (Exception $e) {
}

try {
    $tag->delUsers(['tagid' => 1024, 'userlist' => ['user1', 'user2']]);
} catch (Exception $e) {
}

try {
    $tag->list();
} catch (Exception $e) {
}
