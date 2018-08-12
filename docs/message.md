# 发送应用消息

```php
$app = new \WeWork\App([
    'corp_id' => '企业ID',
    'secret' => '应用密钥',
    'agent_id' => 应用ID,
    'cache' => [
        'path' => __DIR__ . '/cache'
    ],
    'logging' => [
        'path' => __DIR__ . '/log/app.log',
        'level' => 'debug'
    ]
]);
```

```php
/** @var \WeWork\Api\Message $message */
$message = $app->get('message');
```

```php
$receiver = new \WeWork\Message\Receiver();
$receiver->setUser('userid1');
$receiver->setParty([1024, 2048]);
$receiver->setTag([1024, 2048]);
```

## 文本消息

```php
$text = new \WeWork\Message\Text("你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。");
$message->send($receiver, $text, true);
```

## 图片消息

```php
$image = new \WeWork\Message\Image('MEDIA_ID');
$message->send($receiver, $image);
```

## 语音消息

```php
$voice = new \WeWork\Message\Voice('MEDIA_ID');
$message->send($receiver, $voice);
```

## 视频消息

```php
$video = new \WeWork\Message\Video('MEDIA_ID', 'Title', 'Description');
$message->send($receiver, $video);
```

## 文件消息

```php
$file = new \WeWork\Message\File('MEDIA_ID');
$message->send($receiver, $file);
```

## 文本卡片消息

```php
$textCard = new \WeWork\Message\TextCard('领奖通知', "<div class=\"gray\">2016年9月26日</div><div class=\"normal\">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class=\"highlight\">请于2016年10月10日前联系行政同事领取</div>", 'URL', '更多');
$message->send($receiver, $textCard);
```

## 图文消息

```php
$news = new \WeWork\Message\News([
    new \WeWork\Message\Article('中秋节礼品领取', 'URL', '今年中秋节公司有豪礼相送', 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png', '更多')
]);
$message->send($receiver, $news);
```

## 图文消息（mpnews）

```php
$news = new \WeWork\Message\MPNews([
    new \WeWork\Message\MPArticle('Title', 'MEDIA_ID', 'Content', 'Author', 'URL', 'Digest description')
]);
$message->send($receiver, $news);
```
