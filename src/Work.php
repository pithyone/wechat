<?php

namespace pithyone\wechat;

use Arrayy\Arrayy as A;
use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\FilesystemCache;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use pithyone\wechat\Action\Agent;
use pithyone\wechat\Action\Batch;
use pithyone\wechat\Action\Corp;
use pithyone\wechat\Action\Department;
use pithyone\wechat\Action\JSApi;
use pithyone\wechat\Action\Media;
use pithyone\wechat\Action\Menu;
use pithyone\wechat\Action\Message;
use pithyone\wechat\Action\OAuth;
use pithyone\wechat\Action\Tag;
use pithyone\wechat\Action\Token;
use pithyone\wechat\Action\User;
use pithyone\wechat\Server\Server;
use pithyone\wechat\Util\Http;
use pithyone\wechat\Util\Logger;

/**
 * Class Application.
 *
 * @property Agent      $agent
 * @property Batch      $batch
 * @property Corp       $corp
 * @property Department $department
 * @property JSApi      $JSApi
 * @property Media      $media
 * @property Menu       $menu
 * @property Message    $message
 * @property OAuth      $OAuth
 * @property Tag        $tag
 * @property User       $user
 * @property Server     $server
 */
class Work
{
    /**
     * @var Token
     */
    public $token;

    /**
     * @var Http
     */
    protected $http;

    /**
     * @var array
     */
    protected $classes = [
        'agent'      => Agent::class,
        'batch'      => Batch::class,
        'corp'       => Corp::class,
        'department' => Department::class,
        'JSApi'      => JSApi::class,
        'media'      => Media::class,
        'menu'       => Menu::class,
        'message'    => Message::class,
        'OAuth'      => OAuth::class,
        'tag'        => Tag::class,
        'user'       => User::class,
        'server'     => Server::class,
    ];

    /**
     * @var A
     */
    protected $config;

    /**
     * @var string
     */
    protected $agentId;

    /**
     * Work constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = A::create($config);

        $this->initializeLogger();
        $this->initializeCache();

        $this->http ?: $this->http = $this->config->get('http') ?: new Http();
    }

    /**
     * 初始化日志.
     */
    private function initializeLogger()
    {
        $logger = new \Monolog\Logger('WorkWeChat');

        if (!$this->config->get('debug')) {
            $logger->pushHandler(new NullHandler());
        } elseif ($handler = $this->config->get('logger')) {
            if ($handler instanceof AbstractProcessingHandler) {
                $logger->pushHandler($handler);
            } elseif (is_string($handler)) {
                $logger->pushHandler(new StreamHandler($handler));
            }
        }

        Logger::setLogger($logger);
    }

    /**
     * 初始化缓存.
     */
    private function initializeCache()
    {
        if (!($this->config->get('cache') && ($this->config->get('cache') instanceof CacheProvider))) {
            $this->config->set('cache', new FilesystemCache(sys_get_temp_dir()));
        }
    }

    /**
     * @return Token
     */
    private function newToken()
    {
        $token = new Token(
            $this->config->get('corp_id'),
            $this->config->get("{$this->agentId}.secret"),
            $this->agentId,
            $this->http,
            $this->config->get('cache')
        );

        return $token;
    }

    /**
     * @param string $agentId 应用ID
     *
     * @return $this
     */
    public function setAgentId($agentId)
    {
        if (!$this->config->get($agentId)) {
            throw new \InvalidArgumentException("'{$agentId}' is not defined.");
        }

        $old_agentId = $this->agentId;
        $this->agentId = $agentId;

        // 如果重新设置应用ID，相应的，Token也要重新设置
        if ($old_agentId != $agentId || !$this->token) {
            $this->token = $this->config->get('token') ?: $this->newToken();
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (!isset($this->classes[$name])) {
            throw new \InvalidArgumentException("'{$name}' is not defined.");
        }

        $this->http->addQuery(['access_token' => $this->token->get()]);
        $class = $this->classes[$name];

        if (in_array($name, ['agent', 'message', 'menu'])) {
            return new $class($this->http, $this->config->get("{$this->agentId}.agent_id"));
        } elseif ($name == 'JSApi') {
            return new $class($this->http, $this->config->get('cache'), $this->config->get('corp_id'));
        } elseif ($name == 'server') {
            return new $class(
                $this->config->get('corp_id'),
                $this->config->get("{$this->agentId}.token"),
                $this->config->get("{$this->agentId}.aes_key")
            );
        } else {
            return new $class($this->http);
        }
    }
}
