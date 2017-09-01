<?php

namespace pithyone\wechat\Action;

use pithyone\wechat\Message\MPNewsArticle;
use pithyone\wechat\Message\NewsArticle;
use pithyone\wechat\Util\Http;

/**
 * Class Message.
 *
 * @link https://work.weixin.qq.com/api/doc#10167
 *
 * @method $this touser(array $touser) 成员ID列表
 * @method $this toparty(array $toparty) 部门ID列表
 * @method $this totag(array $totag) 标签ID列表
 * @method $this safe($safe = 0) 是否是保密消息
 */
class Message extends Base
{
    const MESSAGE_SEND = '/cgi-bin/message/send';

    /**
     * @var array
     */
    protected $data;

    /**
     * Message constructor.
     *
     * @param Http   $http
     * @param string $agentId
     */
    public function __construct(Http $http, $agentId)
    {
        parent::__construct($http);

        $this->data['agentid'] = $agentId;
    }

    /**
     * @return mixed
     */
    public function send()
    {
        return $this->http->response('JSON', [self::MESSAGE_SEND, $this->data]);
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
        $this->data = array_merge($this->data, ['msgtype' => 'text', 'text' => ['content' => $content]]);

        return $this;
    }

    /**
     * 图片、语音、文件消息.
     *
     * @param string $type    image、voice、file
     * @param string $mediaId 媒体文件id
     *
     * @return $this
     */
    public function media($type, $mediaId)
    {
        $this->data = array_merge($this->data, ['msgtype' => $type, $type => ['media_id' => $mediaId]]);

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
    public function video($mediaId, $title = '', $description = '')
    {
        $this->data = array_merge($this->data, [
            'msgtype' => 'video',
            'video'   => [
                'media_id'    => $mediaId,
                'title'       => $title,
                'description' => $description,
            ],
        ]);

        return $this;
    }

    /**
     * 图文消息.
     *
     * @param string                          $type     news、mpnews
     * @param NewsArticle|MPNewsArticle|array $articles
     *
     * @return $this
     */
    public function news($type, $articles)
    {
        $this->data = array_merge($this->data, [
            'msgtype' => $type,
            $type     => [
                'articles' => array_map(
                    'make'.ucfirst($type),
                    is_array($articles) ? $articles : [$articles]
                ),
            ],
        ]);

        return $this;
    }

    /**
     * 文本卡片消息.
     *
     * @param string $title       标题
     * @param string $description 描述
     * @param string $url         点击后跳转的链接
     * @param string $btnTxt      按钮文字
     *
     * @return $this
     */
    public function textCard($title, $description, $url, $btnTxt = '详情')
    {
        $this->data = array_merge($this->data, [
            'msgtype'  => 'textcard',
            'textcard' => [
                'title'       => $title,
                'description' => $description,
                'url'         => $url,
                'btntxt'      => $btnTxt,
            ],
        ]);

        return $this;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return $this
     */
    public function __call($method, $args)
    {
        $data = $args[0];

        if (in_array($method, ['touser', 'toparty', 'totag']) && is_array($data)) {
            $data = implode('|', $data);
        }

        $this->data[$method] = $data;

        return $this;
    }
}
