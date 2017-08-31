<?php

namespace pithyone\wechat\Util;

use Psr\Log\LoggerInterface;

/**
 * Class Log.
 *
 * @method static emergency($message, array $context = array())
 * @method static alert($message, array $context = array())
 * @method static critical($message, array $context = array())
 * @method static error($message, array $context = array())
 * @method static warning($message, array $context = array())
 * @method static notice($message, array $context = array())
 * @method static info($message, array $context = array())
 * @method static debug($message, array $context = array())
 * @method static log($level, $message, array $context = array())
 */
class Logger
{
    /**
     * @var LoggerInterface
     */
    protected static $logger;

    /**
     * @return LoggerInterface
     */
    public static function getLogger()
    {
        return self::$logger ?: new \Monolog\Logger('WorkWeChat');
    }

    /**
     * @param LoggerInterface $logger
     */
    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getLogger(), $method], $args);
    }
}
