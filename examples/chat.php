<?php

$app = require __DIR__ . '/app.php';

/** @var \WeWork\Api\AppChat $chat */
$chat = $app->get('appChat');

try {
    $chat->create([
        'name' => 'NAME',
        'owner' => 'userid1',
        'userlist' => ['userid1', 'userid2'],
        'chatid' => 'CHATID'
    ]);
} catch (Exception $e) {
}

try {
    $chat->update([
        'chatid' => 'CHATID',
        'name' => 'NAME',
        'owner' => 'userid2'
    ]);
} catch (Exception $e) {
}

try {
    $chat->get('CHATID');
} catch (Exception $e) {
}

try {
    $text = new \WeWork\Message\Text("你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。");
    $chat->send('CHATID', $text, true);
} catch (Exception $e) {
}

try {
    $image = new \WeWork\Message\Image('MEDIA_ID');
    $chat->send('CHATID', $image);
} catch (Exception $e) {
}

try {
    $voice = new \WeWork\Message\Voice('MEDIA_ID');
    $chat->send('CHATID', $voice);
} catch (Exception $e) {
}

try {
    $video = new \WeWork\Message\Video('MEDIA_ID', 'Title', 'Description');
    $chat->send('CHATID', $video);
} catch (Exception $e) {
}

try {
    $file = new \WeWork\Message\File('MEDIA_ID');
    $chat->send('CHATID', $file);
} catch (Exception $e) {
}

try {
    $textCard = new \WeWork\Message\TextCard('领奖通知', "<div class=\"gray\">2016年9月26日</div><div class=\"normal\">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class=\"highlight\">请于2016年10月10日前联系行政同事领取</div>", 'URL', '更多');
    $chat->send('CHATID', $textCard);
} catch (Exception $e) {
}

try {
    $news = new \WeWork\Message\News([
        new \WeWork\Message\Article('中秋节礼品领取', 'URL', '今年中秋节公司有豪礼相送', 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png', '更多')
    ]);
    $chat->send('CHATID', $news);
} catch (Exception $e) {
}

try {
    $news = new \WeWork\Message\MPNews([
        new \WeWork\Message\MPArticle('Title', 'MEDIA_ID', 'Content', 'Author', 'URL', 'Digest description')
    ]);
    $chat->send('CHATID', $news);
} catch (Exception $e) {
}
