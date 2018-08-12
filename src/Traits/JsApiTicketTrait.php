<?php

namespace WeWork\Traits;

use WeWork\ApiCache\JsApiTicket;

trait JsApiTicketTrait
{
    /**
     * @var JsApiTicket
     */
    protected $jsApiTicket;

    /**
     * @param JsApiTicket $jsApiTicket
     */
    public function setJsApiTicket(JsApiTicket $jsApiTicket): void
    {
        $this->jsApiTicket = $jsApiTicket;
    }
}
