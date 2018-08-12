<?php

namespace WeWork;

use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Request;
use WeWork\Crypt\WXBizMsgCrypt;
use WeWork\Message\ReplyMessageInterface;

class Callback
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var WXBizMsgCrypt
     */
    private $crypt;

    /**
     * @param Request $request
     * @param WXBizMsgCrypt $crypt
     */
    public function __construct(Request $request, WXBizMsgCrypt $crypt)
    {
        $this->request = $request;
        $this->crypt = $crypt;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (!$this->request->getContent()) {
            return null;
        }

        if (!$this->request->attributes->has($key)) {
            $this->initializeAttribute();
        }

        return $this->request->attributes->get($key);
    }

    /**
     * @return void
     */
    private function initializeAttribute(): void
    {
        $data = '';

        $this->crypt->DecryptMsg(
            $this->request->query->get('msg_signature'),
            $this->request->query->get('timestamp'),
            $this->request->query->get('nonce'),
            $this->request->getContent(),
            $data
        );

        if ($data) {
            $xml = new SimpleXMLElement($data);

            foreach ($xml as $key => $value) {
                $this->request->attributes->set("$key", "$value");
            }
        }
    }

    /**
     * @return string
     */
    private function decryptEchoStr(): string
    {
        $plainText = '';

        $this->crypt->VerifyURL(
            $this->request->query->get('msg_signature'),
            $this->request->query->get('timestamp'),
            $this->request->query->get('nonce'),
            $this->request->query->get('echostr'),
            $plainText
        );

        return $plainText;
    }

    /**
     * @param ReplyMessageInterface $replyMessage
     * @return string
     */
    public function reply(ReplyMessageInterface $replyMessage): string
    {
        if ($this->request->query->has('echostr')) {
            return $this->decryptEchoStr();
        } else {
            return $this->encryptReply($this->buildReply($replyMessage));
        }
    }

    /**
     * @param string $reply
     * @return string
     */
    private function encryptReply(string $reply): string
    {
        $cipherText = '';

        $this->crypt->EncryptMsg(
            $reply,
            $this->request->query->get('timestamp'),
            $this->request->query->get('nonce'),
            $cipherText
        );

        return $cipherText;
    }

    /**
     * @param ReplyMessageInterface $replyMessage
     * @return string
     */
    private function buildReply(ReplyMessageInterface $replyMessage): string
    {
        $reply = $replyMessage->formatForReply();

        $reply['ToUserName'] = $this->request->attributes->get('FromUserName');
        $reply['FromUserName'] = $this->request->attributes->get('ToUserName');
        $reply['CreateTime'] = (int)$this->request->attributes->get('CreateTime');

        $element = new SimpleXMLElement('<xml/>');

        $this->arrayToXml($reply, $element);

        $dom = dom_import_simplexml($element);

        return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
    }

    /**
     * @param array $data
     * @param SimpleXMLElement $element
     * @return void
     */
    private function arrayToXml(array $data, SimpleXMLElement &$element): void
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }

            if (is_array($value)) {
                $subNode = $element->addChild($key);
                $this->arrayToXml($value, $subNode);
            } elseif (is_string($value)) {
                $node = dom_import_simplexml($element->addChild($key));
                $no = $node->ownerDocument;
                $node->appendChild($no->createCDATASection($value));
            } else {
                $element->addChild($key, $value);
            }
        }
    }
}
