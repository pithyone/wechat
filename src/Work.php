<?php

namespace pithyone\wechat;

use Arrayy\Arrayy;
use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\FilesystemCache;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use pithyone\wechat\Action\Agent;
use pithyone\wechat\Action\Batch;
use pithyone\wechat\Action\Department;
use pithyone\wechat\Action\JSApi;
use pithyone\wechat\Action\Media;
use pithyone\wechat\Action\Menu;
use pithyone\wechat\Action\Message;
use pithyone\wechat\Action\OAuth;
use pithyone\wechat\Action\Tag;
use pithyone\wechat\Action\Token;
use pithyone\wechat\Action\User;
use pithyone\wechat\Core\Http;
use pithyone\wechat\Core\Log;
use pithyone\wechat\Exceptions\RuntimeException;
use pithyone\wechat\Server\Server;

/**
 * Class Application
 *
 * @property \pithyone\wechat\Action\Agent      $agent
 * @property \pithyone\wechat\Action\Batch      $batch
 * @property \pithyone\wechat\Action\Department $department
 * @property \pithyone\wechat\Action\JSApi      $JSApi
 * @property \pithyone\wechat\Action\Media      $media
 * @property \pithyone\wechat\Action\Menu       $menu
 * @property \pithyone\wechat\Action\Message    $message
 * @property \pithyone\wechat\Action\OAuth      $OAuth
 * @property \pithyone\wechat\Action\Tag        $tag
 * @property \pithyone\wechat\Action\User       $user
 * @property \pithyone\wechat\Server\Server     $server
 */
class Work
{
    /**
     * @var Token
     */
    public $token;

    /**
     * @var array
     */
    protected $classes = [
        'agent'      => Agent::class,
        'batch'      => Batch::class,
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
     * @var Arrayy
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
        $this->config = new Arrayy($config);

        $this->initializeLogger();
        $this->initializeCache();
    }

    private function initializeLogger()
    {
        $logger = new Logger('WorkWeChat');

        if (!$this->config->get('debug')) {
            $logger->pushHandler(new NullHandler());
        } elseif ($this->config->get('log.handler') && $this->config->get('log.handler') instanceof AbstractProcessingHandler) {
            $logger->pushHandler($this->config->get('log.handler'));
        } elseif ($logFile = $this->config->get('log.file')) {
            $logger->pushHandler(new StreamHandler($logFile));
        }

        Log::setLogger($logger);
    }

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
            $this->config->get('cache')
        );

        return $token;
    }

    /**
     * @param string $agentId
     *
     * @return $this
     * @throws RuntimeException
     */
    public function setAgentId($agentId)
    {
        if (empty($this->config->get($agentId))) {
            throw new RuntimeException("No agent is selected.");
        }

        $old_agentId = $this->agentId;
        $this->agentId = $agentId;

        // 如果重新设置应用ID，相应的，Token也要重新设置
        if ($old_agentId != $agentId || !$this->token) {
            $this->token = $this->newToken();
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    public function __get($name)
    {
        if (isset($this->classes[$name])) {
            $http = new Http();
            $http->addQuery(['access_token' => $this->token->get()]);
            $class = $this->classes[$name];

            if ($name == 'JSApi') {
                return new $class($http, $this->config->get('cache'), $this->config->get('corp_id'));
            } elseif ($name == 'server') {
                return new $class(
                    $this->config->get('corp_id'),
                    $this->config->get("{$this->agentId}.token"),
                    $this->config->get("{$this->agentId}.aes_key")
                );
            } elseif (in_array($name, ['agent', 'message', 'menu'])) {
                return new $class($http, $this->config->get("{$this->agentId}.agent_id"));
            } else {
                return new $class($http);
            }
        } else {
            throw new RuntimeException("Identifier '{$name}' is not defined.");
        }
    }
}
