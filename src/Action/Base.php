<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Util\Http;

/**
 * Class Base.
 */
class Base
{
    /**
     * @var Http
     */
    protected $http;

    /**
     * Base constructor.
     *
     * @param Http $http
     */
    public function __construct(Http $http)
    {
        $this->http = $http;
    }
}
