<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Callback $callback */
$callback = $app->get('callback');

switch ($callback->get('MsgType')) {
    case 'text':
        echo $callback->reply(new \WeWork\Message\Text($callback->get('Content'))); // 文本消息
        break;
    case 'image':
        echo $callback->reply(new \WeWork\Message\Image($callback->get('MediaId'))); // 图片消息
        break;
    case 'voice':
        echo $callback->reply(new \WeWork\Message\Voice($callback->get('MediaId'))); // 语音消息
        break;
    case 'video':
        echo $callback->reply(new \WeWork\Message\Video($callback->get('MediaId'), 'Title', 'Description')); // 视频消息
        break;
    default:
        $article = new \WeWork\Message\Article('title', 'http://www.soso.com', 'description', 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png');
        echo $callback->reply(new \WeWork\Message\News([$article])); // 图文消息
        break;
}
