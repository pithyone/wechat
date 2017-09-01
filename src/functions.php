<?php
/**
 * functions.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/30
 */
use pithyone\wechat\Message\MPNewsArticle;
use pithyone\wechat\Message\NewsArticle;

/**
 * @param NewsArticle $article
 *
 * @return array
 */
function makeNews(NewsArticle $article)
{
    return [
        'title'       => $article->getTitle(),
        'description' => $article->getDescription(),
        'url'         => $article->getUrl(),
        'picurl'      => $article->getPicUrl(),
        'btntxt'      => $article->getBtnTxt(),
    ];
}

/**
 * @param NewsArticle $article
 *
 * @return array
 */
function makeReplyNews(NewsArticle $article)
{
    return [
        'Title'       => $article->getTitle(),
        'Description' => $article->getDescription(),
        'PicUrl'      => $article->getPicUrl(),
        'Url'         => $article->getUrl(),
    ];
}

/**
 * @param MPNewsArticle $article
 *
 * @return array
 */
function makeMpnews(MPNewsArticle $article)
{
    return [
        'title'              => $article->getTitle(),
        'thumb_media_id'     => $article->getThumbMediaId(),
        'author'             => $article->getAuthor(),
        'content_source_url' => $article->getContentSourceUrl(),
        'content'            => $article->getContent(),
        'digest'             => $article->getDigest(),
    ];
}
