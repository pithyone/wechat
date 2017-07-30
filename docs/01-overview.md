# 概述

> SDK统一调用入口，所有**配置**都需要在初始化时引用，下方会给出完整配置。

## 注意

1. 企业微信每个应用彼此独立，所以每个应用的配置也需要分开
2. API接口调用依赖于企业微信应用，所以初始化接口前需要指定应用

## 完整配置

```php
<?php

return [
    /**
     * Debug 模式，用于记录调试日志
     */
    'debug'    => true,

    /**
     * 日志配置
     *
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log'      => [
        'file' => __DIR__ . '/../tmp/work-wechat.log',
    ],

    /**
     * 企业唯一ID，可在管理后台“我的企业”－“企业信息”下查看（需要有管理员权限）
     */
    'corp_id'  => 'your-corp-id',

    /**
     * 通讯录同步助手配置，可以对部门和成员进行查询、添加、修改、删除操作（其他应用无操作权限）
     *
     * token：   可任意填写，用于生成签名
     * aes_key： 用于消息体的加密
     * secret：  访问密钥，通讯录接口的密钥在“管理工具”-“通讯录同步”里面查看
     */
    'contacts' => [
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret'
    ],

    /**
     * 其他应用配置，注意：需要使用的配置都需要按照如下格式进行添加
     *
     * test：    应用标识，可随意指定（不重复）
     * agent_id：应用ID
     * token：   可任意填写，用于生成签名
     * aes_key： 用于消息体的加密
     * secret：  访问密钥，可以在企业应用的详情里面手动生成
     */
    'test'     => [
        'agent_id' => 'your-test-agent-id',
        'token'    => 'your-test-agent-token',
        'aes_key'  => 'your-test-agent-aes-key',
        'secret'   => 'your-test-agent-secret'
    ],

    // ...
];
```

## 初始化

```php
$work = new Work($config);

// 设置需要操作的应用，注意：此处填写的是应用标识，事先需要在配置中定义
$test = $work->setAgentId('test');

// 设置需要操作的接口
$agent = $test->agent;

// 接口操作...
```

