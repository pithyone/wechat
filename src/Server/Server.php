<?php

namespace pithyone\wechat\Server;

use Arrayy\Arrayy as A;
use LSS\Array2XML;
use LSS\XML2Array;
use pithyone\wechat\Exception\IllegalAesKeyException;
use pithyone\wechat\Exception\ValidateSignatureException;
use pithyone\wechat\Message\NewsArticle;

/**
 * Class Server.
 *
 * @property string $msg_signature
 * @property string $timestamp
 * @property string $nonce
 * @property string $echostr
 * @property string $ToUserName
 * @property string $FromUserName
 * @property string $MsgType
 */
class Server
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $corpId;

    /**
     * @var PrpCrypt
     */
    protected $prpCrypt;

    /**
     * @var SHA1
     */
    protected $sha1;

    /**
     * @var A
     */
    protected $data;

    /**
     * @var array
     */
    protected $package = [];

    /**
     * Server constructor.
     *
     * @param string $corpId         企业的 CorpId
     * @param string $token          企业微信后台，开发者设置的token
     * @param string $encodingAesKey 企业微信后台，开发者设置的EncodingAESKey
     * @param string $message
     *
     * @throws IllegalAesKeyException
     */
    public function __construct($corpId, $token, $encodingAesKey, $message = '')
    {
        $this->data ?: $this->data = A::create(array_map('rawurldecode', $_GET));

        $this->corpId = $corpId;
        $this->token = $token;
        $this->prpCrypt ?: $this->prpCrypt = new PrpCrypt($encodingAesKey);
        $this->sha1 ?: $this->sha1 = new SHA1();

        if (!$this->echostr) {
            $data = XML2Array::createArray($this->decrypt($message), LIBXML_NOCDATA | LIBXML_NOBLANKS);
            $this->data = $this->data->mergeAppendNewIndex($data['xml']);
        }
    }

    /**
     * 被动回复消息.
     *
     * @return bool|string
     */
    public function reply()
    {
        if ($this->echostr) {
            return $this->verify();
        }

        $this->package = array_merge($this->package, [
            'ToUserName'   => $this->FromUserName,
            'FromUserName' => $this->ToUserName,
            'CreateTime'   => $this->timestamp,
        ]);
        $this->make($this->package);

        $xml = Array2XML::createXML('xml', $this->package);

        return $this->encrypt($xml->saveXML($xml->firstChild));
    }

    /**
     * 生成 XML 前整理数组.
     *
     * @param array $array
     */
    private function make(array &$array)
    {
        foreach ($array as $k => &$v) {
            if (is_string($v)) {
                $v = ['@cdata' => $v];
            } elseif (is_array($v)) {
                $normal = count($v) == count($v, COUNT_RECURSIVE);
                $this->make($v);
                $normal || $v = ['item' => $v];
            }
        }
    }

    /**
     * 文本消息.
     *
     * @param string $content 内容
     *
     * @return $this
     */
    public function text($content)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'text',
            'Content' => $content,
        ]);

        return $this;
    }

    /**
     * 图片、语音消息.
     *
     * @param string $type    image、voice
     * @param string $mediaId 媒体文件id
     *
     * @return $this
     */
    public function media($type, $mediaId)
    {
        $this->package = array_merge($this->package, ['MsgType' => $type, ucfirst($type) => ['MediaId' => $mediaId]]);

        return $this;
    }

    /**
     * 视频消息.
     *
     * @param string $mediaId     媒体文件id
     * @param string $title       标题
     * @param string $description 描述
     *
     * @return $this
     */
    public function video($mediaId, $title, $description)
    {
        $this->package = array_merge($this->package, [
            'MsgType' => 'video',
            'Video'   => [
                'MediaId'     => $mediaId,
                'Title'       => $title,
                'Description' => $description,
            ],
        ]);

        return $this;
    }

    /**
     * 图文消息.
     *
     * @param array|NewsArticle $articles
     *
     * @return $this
     */
    public function news($articles)
    {
        $articles = array_map('makeReplyNews', is_array($articles) ? $articles : [$articles]);

        $this->package = array_merge($this->package, [
            'MsgType'      => 'news',
            'ArticleCount' => count($articles),
            'Articles'     => $articles,
        ]);

        return $this;
    }

    /**
     * 验证URL.
     *
     * @throws ValidateSignatureException
     *
     * @return bool|string
     */
    protected function verify()
    {
        $signature = $this->sha1->get($this->token, $this->timestamp, $this->nonce, $this->echostr);

        if ($signature != $this->msg_signature) {
            throw new ValidateSignatureException();
        }

        return $this->prpCrypt->decrypt($this->echostr, $this->corpId);
    }

    /**
     * 检验消息的真实性，并且获取解密后的明文.
     *
     * @param string $message
     *
     * @throws ValidateSignatureException
     *
     * @return bool|string
     */
    protected function decrypt($message = '')
    {
        $message ?: $message = file_get_contents('php://input');

        //提取密文
        $xmlParse = new XMLParse();
        $encrypt = $xmlParse->extract($message);

        //验证安全签名
        $signature = $this->sha1->get($this->token, $this->timestamp, $this->nonce, $encrypt);
        if ($signature != $this->msg_signature) {
            throw new ValidateSignatureException();
        }

        return $this->prpCrypt->decrypt($encrypt, $this->corpId);
    }

    /**
     * 将企业微信回复用户的消息加密打包.
     *
     * @param string $message 企业微信待回复用户的消息，xml格式的字符串
     *
     * @return string
     */
    protected function encrypt($message)
    {
        $encrypt = $this->prpCrypt->encrypt($message, $this->corpId); // 加密

        $timestamp = time();

        $nonce = $this->prpCrypt->getRandomStr();

        $signature = $this->sha1->get($this->token, $timestamp, $nonce, $encrypt); // 生成安全签名

        $xmlParse = new XMLParse(); // 生成发送的xml

        return $xmlParse->generate($encrypt, $signature, $timestamp, $nonce);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data->$name;
    }

    /**
     * @return A
     */
    public function getData()
    {
        return $this->data;
    }
}
