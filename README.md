# Work WeChat

📦 最最最简单易用的[企业微信](https://work.weixin.qq.com/)SDK

## 介绍

虽然企业微信**很坑**，但是大厂的东西还是要去适配，所以有了这么个东西。

> 暂不支持企业支付相关接口，已列入后续开发计划

## 要求

- PHP >= 5.5.26

## 安装

```shell
composer require pithyone/wechat
```

## 用法

> 可直接参考 [demo](examples)

- [概述](docs/01-overview.md)
- [AccessToken](docs/02-token.md)
- [成员管理](docs/02-user.md)
- [部门管理](docs/03-department.md)
- [标签管理](docs/04-tag.md)
- [应用管理](docs/05-agent.md)
- [发送消息](docs/06-message.md)
- [接收消息](docs/07-receive.md)
- [被动回复消息](docs/08-reply.md)
- [JS-API](docs/09-js-api.md)
- [网页授权](docs/10-oauth.md)
- [自定义菜单](docs/11-menu.md)
- [素材管理](docs/12-media.md)

## 自定义

- [缓存](docs/100001-custom-cache.md)
- [日志](docs/100002-custom-log.md)

## 致谢

- [overtrue/wechat](https://github.com/overtrue/wechat)

## License

MIT
