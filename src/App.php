<?php

namespace WeWork;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;
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
     * @var ArrayCollection
     */
    private $config;

    /**
     * @var array
     */
    private $apiServices = [
        'agent'      => Api\Agent::class,
        'appChat'    => Api\AppChat::class,
        'batch'      => Api\Batch::class,
        'checkIn'    => Api\CheckIn::class,
        'corp'       => Api\Corp::class,
        'crm'        => Api\CRM::class,
        'department' => Api\Department::class,
        'invoice'    => Api\Invoice::class,
        'media'      => Api\Media::class,
        'menu'       => Api\Menu::class,
        'message'    => Api\Message::class,
        'tag'        => Api\Tag::class,
        'user'       => Api\User::class,
    ];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this->config = new ArrayCollection($config);

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
        $log = $this->config->get('log');

        if (is_subclass_of($log, LoggerInterface::class)) {
            $this->register('logger', $log);
        } elseif ($log) {
            $this->register('logger_handler', StreamHandler::class)
                ->setArguments([$log['file'], isset($log['level']) ? $log['level'] : 'debug']);
            $this->registerMonolog();
        } else {
            $this->register('logger_handler', NullHandler::class);
            $this->registerMonolog();
        }
    }

    /**
     * @return void
     */
    private function registerMonolog(): void
    {
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
        $cache = $this->config->get('cache');

        if (is_subclass_of($cache, CacheInterface::class)) {
            $this->register('cache', $cache);
        } else {
            $service = $this->register('cache', FilesystemCache::class);

            if ($cache && isset($cache['path'])) {
                $service->setArguments(['', 0, $cache['path']]);
            }
        }
    }

    /**
     * @return void
     */
    private function registerToken(): void
    {
        $this->register('token', Token::class)
            ->addMethodCall('setCorpId', [$this->config->get('corp_id')])
            ->addMethodCall('setSecret', [$this->config->get('secret')])
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
            ->setArguments([$this->config->get('token'), $this->config->get('aes_key'), $this->config->get('corp_id')]);

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
     *
     * @return void
     */
    private function registerApi(string $id, string $class): void
    {
        $api = $this->register($id, $class)
            ->addMethodCall('setHttpClient', [new Reference('http_client_with_token')]);

        if (in_array($id, ['agent', 'menu', 'message'])) {
            $api->addMethodCall('setAgentId', [$this->config->get('agent_id')]);
        }
    }

    /**
     * @return void
     */
    private function registerJsApiTicket(): void
    {
        $this->register('jsApiTicket', JsApiTicket::class)
            ->addMethodCall('setSecret', [$this->config->get('secret')])
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
            ->addMethodCall('setCorpId', [$this->config->get('corp_id')])
            ->addMethodCall('setJsApiTicket', [new Reference('jsApiTicket')])
            ->addMethodCall('setTicket', [new Reference('ticket')]);
    }
}
