# 素材管理

```php
$media = $app->get('media');
```

## 上传临时素材

```php
$media->upload('file', __DIR__ . '/public/wework.txt');
```

## 获取临时素材

```php
$media->get('MEDIA_ID');
```

## 获取高清语音素材

```php
$media->getVoice('MEDIA_ID');
```

## 上传图片

```php
$media->uploadImg(__DIR__ . '/public/20180103195745.png');
```
