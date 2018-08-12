<?php

namespace WeWork;

use WeWork\Crypt\PrpCrypt;
use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\JsApiTicketTrait;
use WeWork\Traits\TicketTrait;

class JSSdk
{
    use CorpIdTrait, JsApiTicketTrait, TicketTrait;

    /**
     * @param string $url
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getConfig(string $url): array
    {
        $appId = $this->corpId;

        $timestamp = $this->getTimestamp();

        $nonceStr = $this->getNonceStr();

        $signature = sha1("jsapi_ticket={$this->jsApiTicket->get()}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}");

        return compact('appId', 'timestamp', 'nonceStr', 'signature');
    }

    /**
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getChooseInvoiceConfig(): array
    {
        $timestamp = $this->getTimestamp();

        $nonceStr = $this->getNonceStr();

        $array = ['INVOICE', $this->corpId, $timestamp, $nonceStr, $this->ticket->get()];

        sort($array, SORT_STRING);

        $str = implode($array);

        $cardSign = sha1($str);

        return compact('timestamp', 'nonceStr', 'cardSign');
    }

    /**
     * @return int
     */
    protected function getTimestamp(): int
    {
        return time();
    }

    /**
     * @return string
     */
    protected function getNonceStr(): string
    {
        return (new PrpCrypt(null))->getRandomStr();
    }
}
