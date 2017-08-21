<?php

require __DIR__.'/../vendor/autoload.php';

use pithyone\wechat\Message\File;
use pithyone\wechat\Message\Image;
use pithyone\wechat\Message\MpNews;
use pithyone\wechat\Message\MpNewsArticle;
use pithyone\wechat\Message\News;
use pithyone\wechat\Message\NewsArticle;
use pithyone\wechat\Message\Text;
use pithyone\wechat\Message\TextCard;
use pithyone\wechat\Message\Video;
use pithyone\wechat\Message\Voice;
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
$message = $test->message;

// 文本消息
$text = new Text();
$text->content = '文本消息';
$message->touser(['wb'])->send($text);

// 图片消息
$image = new Image();
$image->media_id = '1KCbkMnXUE30Nqv9gkIDpiI_-GMkuls8NHmzjp7mRqnw';
$message->touser(['wb'])->send($image);

// 语音消息
$voice = new Voice();
$voice->media_id = '1O0m77lCKgYZa6Hge7Zcbe2lp7MFIlH1eLZ9-jBmwMcw';
$message->touser(['wb'])->safe(1)->send($voice);

// 视频消息
$video = new Video();
$video->media_id = '1P5w5WIYXJEw33rnB8DaswjIRJyhM1WCvS1mkjpLMNWk';
$video->title = '武汉';
$video->description = '武汉 - 光谷大桥';
$message->touser(['wb'])->send($video);

// 文件消息
$file = new File();
$file->media_id = '1KCbkMnXUE30Nqv9gkIDpiI_-GMkuls8NHmzjp7mRqnw';
$message->touser(['wb'])->send($file);

// 文本卡片消息
$textCard = new TextCard();
$textCard->title = '领奖通知';
$textCard->description = '<div class="gray">2016年9月26日</div> <div class="normal">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class="highlight">请于2016年10月10日前联系行政同事领取</div>';
$textCard->url = 'http://www.soso.com';
$textCard->btntxt = '查看详情';
$message->touser(['wb'])->send($textCard);

// 图文消息
$newsArticle = new NewsArticle();
$newsArticle->title = '中秋节礼品领取';
$newsArticle->description = '今年中秋节公司有豪礼相送';
$newsArticle->url = 'http://www.soso.com';
$newsArticle->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';
$news = new News();
$news->articles = [$newsArticle];
$message->touser(['wb'])->send($news);

// 图文消息（mpnews）
$mpNewsArticle = new MpNewsArticle();
$mpNewsArticle->title = '树叶';
$mpNewsArticle->thumb_media_id = '1KCbkMnXUE30Nqv9gkIDpiI_-GMkuls8NHmzjp7mRqnw';
$mpNewsArticle->author = '大地';
$mpNewsArticle->content_source_url = 'http://www.soso.com';
$mpNewsArticle->content = '绿茵茵的树叶';
$mpNewsArticle->digest = '绿茵茵的树叶';
$mpNews = new MpNews();
$mpNews->articles = $mpNewsArticle;
$message->touser(['wb'])->send($mpNews);
