# 接收消息与事件

只需要配置 `corp_id` `token` `aes_key` 即可。

```php
$callback = $app->get('callback');
```

示例：

```php
switch ($callback->get('MsgType')) {
    case 'text': // 文本消息
        echo $callback->reply(new \WeWork\Message\Text($callback->get('Content')));
        break;
    case 'image': // 图片消息
        echo $callback->reply(new \WeWork\Message\Image($callback->get('MediaId')));
        break;
    case 'voice': // 语音消息
        echo $callback->reply(new \WeWork\Message\Voice($callback->get('MediaId')));
        break;
    case 'video': // 视频消息
        $video = new \WeWork\Message\Video($callback->get('MediaId'), 'Title', 'Description');
        echo $callback->reply($video);
        break;
    default: // 图文消息
        $article = new \WeWork\Message\Article(
            'title',
            'http://www.soso.com',
            'description',
            'http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png'
        );
        echo $callback->reply(new \WeWork\Message\News([$article]));
        break;
}
```
