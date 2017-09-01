# Work WeChat

[![StyleCI](https://styleci.io/repos/98778013/shield?branch=master&style=flat)](https://styleci.io/repos/98778013)
[![Build Status](https://travis-ci.org/pithyone/wechat.svg?branch=master)](https://travis-ci.org/pithyone/wechat)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pithyone/wechat/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pithyone/wechat/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pithyone/wechat/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pithyone/wechat/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/pithyone/wechat/v/stable)](https://packagist.org/packages/pithyone/wechat)
[![Latest Unstable Version](https://poser.pugx.org/pithyone/wechat/v/unstable)](https://packagist.org/packages/pithyone/wechat)
[![License](https://poser.pugx.org/pithyone/wechat/license)](https://packagist.org/packages/pithyone/wechat)

:package: 最最最简单易用的[企业微信](https://work.weixin.qq.com/)SDK

## Introduction

虽然企业微信**很坑**，但是大厂的东西还是要去适配，所以有了这么个东西

> 暂不支持[企业支付](https://work.weixin.qq.com/api/doc#11478)、[电子发票](https://work.weixin.qq.com/api/doc#11630)、[第三方开放接口](https://work.weixin.qq.com/api/doc#10968)，已列入后续开发计划 :bookmark:

## Requirement

- PHP >= 5.6
- OpenSSL PHP Extension

## Installation

```shell
composer require pithyone/wechat
```

## Notice

> 每个应用有独立的secret，所以每个应用的access_token应该分开来获取

企业微信 `API` 请求以应用作为基础，每个应用相互独立，所以初始化 [`Work`](/src/Work.php) 后需要 `setAgentId` 设置操作的应用

## Usage

```php
<?php

use pithyone\wechat\Work;

$config = [
    'debug'    => true, // 调试模式，用于记录请求日志
    'logger'   => __DIR__.'/../tmp/work-wechat.log', // 日志文件位置
    'corp_id'  => 'your-corp-id', // 企业CorpID
    'contacts' => [ // 通讯录同步应用配置
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret',
    ],
    'test'     => [ // 你的自建应用
        'agent_id' => 'your-test-agent-id', // 应用ID
        'token'    => 'your-test-agent-token', // 用于生成签名
        'aes_key'  => 'your-test-agent-aes-key', // AES密钥
        'secret'   => 'your-test-agent-secret', // 应用密钥
    ],
    // 更多自建应用或者第三方应用，配置格式参照 test 应用
];

$work = new Work($config);

// 选中通讯录同步应用
$contacts = $work->setAgentId('contacts');
$token = $contacts->token;
echo $token->get();

// 选中你的自建应用
$test = $work->setAgentId('test');
$token = $test->token;
echo $token->get();
```
更多详细用法请参考[示例](examples/index.md)

## Documentation

- [企业微信官方开发文档](https://work.weixin.qq.com/api/doc)

## Advanced

- [自定义缓存](docs/custom-cache.md)
- [自定义日志](docs/custom-log.md)

## Integration

- [企业微信SDK for ThinkPHP5](https://github.com/pithyone/think-wechat)

## Thanks

- [overtrue/wechat](https://github.com/overtrue/wechat)

## License

MIT
