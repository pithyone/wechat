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
        'agent_id' => 0,
        'secret'   => 'fsAQmTHCGvd5ZsRJnkr9jj9aCR2sqOKypAUw6D3Jy5Y',
        'token'    => 'U2AemzcBENS2vaZHio6DbIEXBTZWgxI',
        'aes_key'  => 'oQDmXL6uyPhtcREx4MV1LGH3BYA4fizacLkD53FHuJT',
        'cache'    => [
            'path' => '/cache',
        ],
        'logging'  => [
            'path'  => '/log/app.log',
            'level' => 'debug',
        ],
    ]
);
```

以获取 access_token 为例：

```php
$app->get('token')->get();
```
