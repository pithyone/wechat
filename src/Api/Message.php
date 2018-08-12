<?php

namespace WeWork\Api;

use WeWork\Message\Receiver;
use WeWork\Message\ResponseMessageInterface;
use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;

class Message
{
    use HttpClientTrait, AgentIdTrait;

    /**
     * 发送应用消息
     *
     * @param Receiver $receiver
     * @param ResponseMessageInterface $responseMessage
     * @param bool $safe
     * @return array
     */
    public function send(Receiver $receiver, ResponseMessageInterface $responseMessage, bool $safe = false): array
    {
        return $this->httpClient->postJson('message/send', array_merge(
            ['agentid' => $this->agentId],
            $receiver->get(),
            $responseMessage->formatForResponse(),
            ['safe' => (int)$safe]
        ));
    }
}
