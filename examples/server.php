<?php

require __DIR__.'/../vendor/autoload.php';

use pithyone\wechat\Message\NewsArticle;
use pithyone\wechat\Work;

spl_autoload_register(function ($c) {
    @include_once strtr($c, '\\_', '//').'.php';
});
set_include_path(get_include_path().PATH_SEPARATOR.dirname(__DIR__).'/src');

$config = [
    'debug'    => true,
    'log'      => [
        'file' => __DIR__.'/../tmp/work-wechat.log',
    ],
    'corp_id'  => 'your-corp-id',
    'contacts' => [
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret',
    ],
    'test'     => [
        'agent_id' => 'your-test-agent-id',
        'token'    => 'your-test-agent-token',
        'aes_key'  => 'your-test-agent-aes-key',
        'secret'   => 'your-test-agent-secret',
    ],
];

$work = new Work($config);

$test = $work->setAgentId('test');
$server = $test->server;

switch ($server->MsgType) {
    case 'text':
        // 回复文本消息
        $server->setText($server->Content);
        break;
    case 'image':
        // 回复图片消息
        $server->setImage($server->MediaId);
        break;
    case 'voice':
        // 回复语音消息
        $server->setVoice($server->MediaId);
        break;
    case 'video':
        // 回复视频消息
        $server->setVideo($server->MediaId, 'Title', 'Description');
        break;
    default:
        // 默认回复消息，用于调试
        $server->setText(json_encode($server->getData()->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        break;
}

// 回复图文消息
$newsArticle = new NewsArticle();
$newsArticle->title = 'title';
$newsArticle->description = 'description';
$newsArticle->url = 'http://www.soso.com';
$newsArticle->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';
$newsArticle2 = new NewsArticle();
$newsArticle2->title = 'title2';
$newsArticle2->description = 'description2';
$newsArticle2->url = 'http://www.soso.com';
$newsArticle2->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';
$server->setNews([$newsArticle, $newsArticle2]);

echo $server->reply();
