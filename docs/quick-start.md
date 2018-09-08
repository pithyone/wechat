# 快速开始

## 安装

``` bash
composer require pithyone/wechat
```

## 用法

初始化：

```php
$app = new \WeWork\App(
    [
        'corp_id'  => 'xxxxxxxxxxxxxxxxxx',
        'secret'   => 'fsAQmTHCGvd5ZsRJnkr9jj9aCR2sqOKypAUw6D3Jy5Y',
        'agent_id' => 0,
        'token'    => 'cxvhat5gfJW30J9YUsq',
        'aes_key'  => 'ULPUgqKDC8LTI1fRJ1jOxHrwbUV2QxR5jnSKrlh4meT',
        'cache'    => [
            'path' => __DIR__.'/cache',
        ],
        'log'      => [
            'file'  => __DIR__.'/log/app.log',
            'level' => 'debug',
        ],
    ]
);
```

以获取 access_token 为例：

```php
$app->get('token')->get();
```
