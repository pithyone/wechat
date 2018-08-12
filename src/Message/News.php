<?php

namespace WeWork\Message;

class News implements ResponseMessageInterface, ReplyMessageInterface
{
    /**
     * @var Article[]
     */
    private $articles;

    /**
     * @param Article[] $articles
     */
    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return array
     */
    public function formatForReply(): array
    {
        return [
            'MsgType' => 'news',
            'ArticleCount' => count($this->articles),
            'Articles' => array_map(function (Article $article) {
                return $article->formatForReply();
            }, $this->articles)
        ];
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'news',
            'news' => [
                'articles' => array_map(function (Article $article) {
                    return $article->formatForResponse();
                }, $this->articles)
            ]
        ];
    }
}
