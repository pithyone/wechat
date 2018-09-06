# 发送消息到群聊会话

```php
$chat = $app->get('appChat');
```

## 创建群聊会话

```php
$chat->create([
    'name' => 'NAME',
    'owner' => 'userid1',
    'userlist' => ['userid1', 'userid2'],
    'chatid' => 'CHATID'
]);
```

## 修改群聊会话

```php
$chat->update([
    'chatid' => 'CHATID',
    'name' => 'NAME',
    'owner' => 'userid2'
]);
```

## 获取群聊会话

```php
$chat->get('CHATID');
```

## 应用推送消息

```php
$text = new \WeWork\Message\Text("你的快递已到，请携带工卡前往邮件中心领取。\n出发前可查看<a href=\"http://work.weixin.qq.com\">邮件中心视频实况</a>，聪明避开排队。");
$chat->send('CHATID', $text, true);
```
