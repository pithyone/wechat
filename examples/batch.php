<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\Batch $batch */
$batch = $app->get('batch');

try {
    $batch->invite([
        'user' => ['UserID1', 'UserID2', 'UserID3']
    ]);
} catch (Exception $e) {
}

try {
    $batch->syncUser(['media_id' => 'xxxxxx']);
} catch (Exception $e) {
}

try {
    $batch->replaceUser(['media_id' => 'xxxxxx']);
} catch (Exception $e) {
}

try {
    $batch->replaceParty(['media_id' => 'xxxxxx']);
} catch (Exception $e) {
}

try {
    $batch->getResult('JOBID');
} catch (Exception $e) {
}
