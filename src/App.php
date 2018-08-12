<?php

namespace WeWork;

use GuzzleHttp\Client;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use WeWork\ApiCache\JsApiTicket;
use WeWork\ApiCache\Ticket;
use WeWork\ApiCache\Token;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Http\ClientFactory;
use WeWork\Http\HttpClient;

class App extends ContainerBuilder
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $apiServices = [
        'agent' => Api\Agent::class,
        'appChat' => Api\AppChat::class,
        'batch' => Api\Batch::class,
        'checkIn' => Api\CheckIn::class,
        'corp' => Api\Corp::class,
        'crm' => Api\CRM::class,
        'department' => Api\Department::class,
        'invoice' => Api\Invoice::class,
        'media' => Api\Media::class,
        'menu' => Api\Menu::class,
        'message' => Api\Message::class,
        'tag' => Api\Tag::class,
        'user' => Api\User::class
    ];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this->config = $config;

        $this->registerServices();
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $this->registerLogger();
        $this->registerHttpClient();
        $this->registerCache();
        $this->registerToken();
        $this->registerCallback();
        $this->registerHttpClientWithToken();

        foreach ($this->apiServices as $id => $class) {
            $this->registerApi($id, $class);
        }

        $this->registerJsApiTicket();
        $this->registerTicket();
        $this->registerJssdk();
    }

    /**
     * @return void
     */
    private function registerLogger(): void
    {
        if ($this->config['logging']) {
            $this->register('logger_handler', StreamHandler::class)
                ->setArguments([$this->config['logging']['path'], $this->config['logging']['level']]);
        } else {
            $this->register('logger_handler', NullHandler::class);
        }

        $this->register('logger', Logger::class)
            ->addArgument('WeWork')
            ->addMethodCall('setTimezone', [new \DateTimeZone('PRC')])
            ->addMethodCall('pushHandler', [new Reference('logger_handler')]);
    }

    /**
     * @return void
     */
    private function registerHttpClient(): void
    {
        $this->register('client', Client::class)
            ->addArgument(new Reference('logger'))
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client', HttpClient::class)
            ->addArgument(new Reference('client'));
    }

    /**
     * @return void
     */
    private function registerCache(): void
    {
        if ($driver = $this->config['cache']['driver']) {
            $cache = $this->register('cache', $driver);
        } else {
            $cache = $this->register('cache', FilesystemCache::class);
        }

        if ($this->config['cache']['path']) {
            $cache->setArguments(['', 0, $this->config['cache']['path']]);
        }
    }

    /**
     * @return void
     */
    private function registerToken(): void
    {
        $this->register('token', Token::class)
            ->addMethodCall('setCorpId', [$this->config['corp_id']])
            ->addMethodCall('setSecret', [$this->config['secret']])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client')]);
    }

    /**
     * @return void
     */
    private function registerCallback(): void
    {
        $this->register('request', Request::class)
            ->setFactory([Request::class, 'createFromGlobals']);

        $this->register('crypt', WXBizMsgCrypt::class)
            ->setArguments([$this->config['token'], $this->config['aes_key'], $this->config['corp_id']]);

        $this->register('callback', Callback::class)
            ->setArguments([new Reference('request'), new Reference('crypt')]);
    }

    /**
     * @return void
     */
    private function registerHttpClientWithToken(): void
    {
        $this->register('client_with_token', Client::class)
            ->setArguments([new Reference('logger'), new Reference('token')])
            ->setFactory([ClientFactory::class, 'create']);

        $this->register('http_client_with_token', HttpClient::class)
            ->addArgument(new Reference('client_with_token'));
    }

    /**
     * @param string $id
     * @param string $class
     * @return void
     */
    private function registerApi(string $id, string $class): void
    {
        $api = $this->register($id, $class)
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);

        if (in_array($id, ['agent', 'menu', 'message'])) {
            $api->addMethodCall('setAgentId', [$this->config['agent_id']]);
        }
    }

    /**
     * @return void
     */
    private function registerJsApiTicket(): void
    {
        $this->register('jsApiTicket', JsApiTicket::class)
            ->addMethodCall('setSecret', [$this->config['secret']])
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);
    }

    /**
     * @return void
     */
    private function registerTicket(): void
    {
        $this->register('ticket', Ticket::class)
            ->addMethodCall('setCache', [new Reference('cache')])
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);
    }

    /**
     * @return void
     */
    private function registerJssdk(): void
    {
        $this->register('jssdk', JSSdk::class)
            ->addMethodCall('setCorpId', [$this->config['corp_id']])
            ->addMethodCall('setJsApiTicket', [new Reference('jsApiTicket')])
            ->addMethodCall('setTicket', [new Reference('ticket')]);
    }
}
