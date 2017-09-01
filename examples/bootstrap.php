<?php
/**
 * bootstrap.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require __DIR__.'/../vendor/autoload.php';

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
    'chart'    => [ // 打卡应用配置，用于获取打卡数据
        'agent_id' => 'your-chart-agent-id',
        'secret'   => 'your-chart-agent-secret',
    ],
    'approval' => [ // 审批应用配置，用于获取审批数据
        'agent_id' => 'your-approval-agent-id',
        'secret'   => 'your-approval-agent-secret',
    ],
    'test'     => [ // 你的自建应用
        'agent_id' => 'your-test-agent-id', // 应用ID
        'token'    => 'your-test-agent-token', // 用于生成签名
        'aes_key'  => 'your-test-agent-aes-key', // AES密钥
        'secret'   => 'your-test-agent-secret', // 应用密钥
    ],
];

$work = new Work($config);
