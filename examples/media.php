<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Media $media */
$media = $app->get('media');

try {
    $media->upload('file', __DIR__ . '/public/wework.txt');
} catch (Exception $e) {
}

try {
    $data = $media->get('MEDIA_ID');
    file_put_contents(__DIR__ . '/app/MEDIA_ID.jpg', $data);
} catch (Exception $e) {
}

try {
    $data = $media->getVoice('MEDIA_ID');
    file_put_contents(__DIR__ . '/app/XXX', $data);
} catch (Exception $e) {
}

try {
    $media->uploadImg(__DIR__ . '/public/20180103195745.png');
} catch (Exception $e) {
}
