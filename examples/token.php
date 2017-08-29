<?php

require __DIR__.'/../vendor/autoload.php';

use pithyone\wechat\Work;

spl_autoload_register(function ($c) {
    @include_once strtr($c, '\\_', '//').'.php';
});
set_include_path(get_include_path().PATH_SEPARATOR.dirname(__DIR__).'/src');

$config = [
    'debug'    => true,
    'log'      => [
        'file' => __DIR__.'/../tmp/work-wechat.log',
    ],
    'corp_id'  => 'your-corp-id',
    'contacts' => [
        'token'   => 'your-contacts-agent-token',
        'aes_key' => 'your-contacts-agent-aes-key',
        'secret'  => 'your-contacts-agent-secret',
    ],
    'test'     => [
        'agent_id' => 'your-test-agent-id',
        'token'    => 'your-test-agent-token',
        'aes_key'  => 'your-test-agent-aes-key',
        'secret'   => 'your-test-agent-secret',
    ],
];

$work = new Work($config);

$test = $work->setAgentId('test');
$token = $test->token;
$token->get();

$contacts = $work->setAgentId('contacts');
$token = $contacts->token;
$token->get();
