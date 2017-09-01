<?php
/**
 * server.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

use pithyone\wechat\Message\NewsArticle;
use pithyone\wechat\Util\Logger;

$test = $work->setAgentId('test');
$server = $test->server;

Logger::debug('server', $server->getData()->toArray());

switch ($server->MsgType) {
    case 'text':
        if ($server->Content == '图文') { // 回复图文消息
            $article1 = new NewsArticle(
                'title1',
                'http://www.soso.com',
                'description1',
                'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png'
            );

            $article2 = new NewsArticle('title2', 'http://www.qq.com');

            $server->news([$article1, $article2]);
        } else { // 回复文本消息
            $server->text($server->Content);
        }
        break;
    case 'image':
        // 回复图片消息
        $server->media('image', $server->MediaId);
        break;
    case 'voice':
        // 回复语音消息
        $server->media('voice', $server->MediaId);
        break;
    case 'video':
        // 回复视频消息
        $server->video($server->MediaId, 'Title', 'Description');
        break;
    default:
        // 默认回复消息，用于调试
        $server->text(json_encode($server->getData()->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        break;
}

echo $server->reply();
