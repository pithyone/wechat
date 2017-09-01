<?php
/**
 * message.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

use pithyone\wechat\Message\MpNewsArticle;
use pithyone\wechat\Message\NewsArticle;

$test = $work->setAgentId('test');
$message = $test->message;

// 文本消息
//var_dump($message->touser(['wb'])->text('文本消息')->send());

// 图片消息
//var_dump($message
//    ->touser(['wb'])
//    ->media('image', '1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p')
//    ->send());

// 语音消息
//var_dump($message
//    ->touser(['wb'])
//    ->safe(1)
//    ->media('voice', '1hVfA-0XGW7JdiWj1GPnffA7PCuKILeRMMyQBWdXPUII')
//    ->send());

// 视频消息
//var_dump($message
//    ->touser(['wb'])
//    ->video(
//        '1InLrL71VTYmjFXYTaelD5pHU6KC1GCWeVFvFDkhSiXOMZux2-GsHYreqwsHSpX86',
//        'Title',
//        'Description'
//    )
//    ->send());

// 文件消息
//var_dump($message
//    ->touser(['wb'])
//    ->media('file', '1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p')
//    ->send());

// 文本卡片消息
//var_dump($message
//    ->touser(['wb'])
//    ->textCard(
//        '领奖通知',
//        '<div class="gray">2016年9月26日</div> <div class="normal">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class="highlight">请于2016年10月10日前联系行政同事领取</div>',
//        'http://www.soso.com',
//        '更多'
//    )
//    ->send());

// 图文消息
$article = new NewsArticle(
    '中秋节礼品领取',
    'http://www.soso.com',
    '今年中秋节公司有豪礼相送',
    'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png',
    '更多'
);
//var_dump($message->touser(['wb'])->news('news', [$article])->send());

// 图文消息（mpnews）
$article = new MpNewsArticle(
    'Title',
    '1fdSYYZY0Hx81jPTYhpiWFPXPlMB27HTlQHzaPhC25br6i1tjC_EQ4no0pYN9WD5p',
    'Content',
    'Author',
    'http://www.soso.com',
    'Digest description'
);
//var_dump($message->touser(['wb'])->news('mpnews', [$article])->send());
