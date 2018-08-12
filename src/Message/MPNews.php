<?php

namespace WeWork\Message;

class MPNews implements ResponseMessageInterface
{
    /**
     * @var MPArticle[]
     */
    private $articles;

    /**
     * @param MPArticle[] $articles
     */
    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return array
     */
    public function formatForResponse(): array
    {
        return [
            'msgtype' => 'mpnews',
            'mpnews' => [
                'articles' => array_map(function (MPArticle $article) {
                    return $article->formatForResponse();
                }, $this->articles)
            ]
        ];
    }
}
