# 发送消息

## 目录

- [获取实例](#获取实例)
- API接口
    - [文本消息](#文本消息)
    - [图片消息](#图片消息)
    - [语音消息](#语音消息)
    - [视频消息](#视频消息)
    - [文件消息](#文件消息)
    - [文本卡片消息](#文本卡片消息)
    - [图文消息](#图文消息)
    - [图文消息（mpnews）](#图文消息（mpnews）)

> 可直接参考 [demo](../examples/message.php)

## 获取实例

```php
<?php

use pithyone\wechat\Work;

// ...

$work = new Work($config);

$test = $work->setAgentId('test');

$message = $test->message;
```

## 文本消息

```php
$text = new Text();
$text->content = "你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。";

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($text);
```

## 图片消息

```php
$image = new Image();
$image->media_id = 'MEDIA_ID';

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($image);
```

## 语音消息

```php
$voice = new Voice();
$voice->media_id = 'MEDIA_ID';

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($voice);
```

## 视频消息

```php
$video = new Video();
$video->media_id = 'MEDIA_ID';
$video->title = 'Title';
$video->description = 'Description';

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($video);
```

## 文件消息

```php
$file = new File();
$file->media_id = 'MEDIA_ID';

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($file);
```

## 文本卡片消息

```php
$textCard = new TextCard();
$textCard->title = '领奖通知';
$textCard->description = "<div class=\"gray\">2016年9月26日</div> <div class=\"normal\">恭喜你抽中iPhone 7一台，领奖码：xxxx</div><div class=\"highlight\">请于2016年10月10日前联系行政同事领取</div>";
$textCard->url = 'http://www.soso.com';
$textCard->btntxt = '查看详情';

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($textCard);
```

## 图文消息

```php
$newsArticle = new NewsArticle();
$newsArticle->title = '中秋节礼品领取';
$newsArticle->description = '今年中秋节公司有豪礼相送';
$newsArticle->url = 'http://www.soso.com';
$newsArticle->picurl = 'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png';

$news = new News();
$news->articles = [$newsArticle];

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($news);
```

## 图文消息（mpnews）

```php
$mpNewsArticle = new MpNewsArticle();
$mpNewsArticle->title = 'Title';
$mpNewsArticle->thumb_media_id = 'MEDIA_ID';
$mpNewsArticle->author = 'Author';
$mpNewsArticle->content_source_url = 'URL';
$mpNewsArticle->content = 'Content';
$mpNewsArticle->digest = 'Digest description';

$mpNews = new MpNews();
$mpNews->articles = [$mpNewsArticle];

$message->touser([$userid1, $userid2])->toparty([$partyid1, $partyid2])->totag([$tagid1, $tagid2])->safe(0)->send($mpNews);
```
