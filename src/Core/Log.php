<?php

namespace pithyone\wechat\Core;


use Monolog\Logger;

/**
 * Class Log
 *
 * @method static debug($message, $context = null)
 * @method static info($message, $context = null)
 * @method static notice($message, $context = null)
 * @method static warning($message, $context = null)
 * @method static error($message, $context = null)
 * @method static critical($message, $context = null)
 * @method static alert($message, $context = null)
 * @method static emergency($message, $context = null)
 *
 * @package pithyone\zhihu\crawler
 */
class Log
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected static $logger;

    /**
     * @return Logger
     * @author wangbing <pithyone@vip.qq.com>
     */
    private static function createLogger()
    {
        $log = new Logger('WorkWeChat');

        return $log;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     * @author wangbing <pithyone@vip.qq.com>
     */
    public static function getLogger()
    {
        return self::$logger ?: self::createLogger();
    }

    /**
     * @param Logger $logger
     */
    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getLogger(), $method], $args);
    }

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     * @author wangbing <pithyone@vip.qq.com>
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::getLogger(), $method], $args);
    }
}