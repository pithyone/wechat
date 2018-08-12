<?php

namespace WeWork\Tests\Message;

use WeWork\Message\MPArticle;
use WeWork\Message\MPNews;
use WeWork\Tests\TestCase;

class MPNewsTest extends TestCase
{
    /**
     * @var MPNews
     */
    protected $news;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->news = new MPNews([new MPArticle('title', 'thumb_media_id', 'content', 'author', 'content_source_url', 'digest')]);
    }

    /**
     * @return void
     */
    public function testFormatForResponse()
    {
        $this->assertEquals([
            'msgtype' => 'mpnews',
            'mpnews' => [
                'articles' => [
                    [
                        'title' => 'title',
                        'thumb_media_id' => 'thumb_media_id',
                        'author' => 'author',
                        'content_source_url' => 'content_source_url',
                        'content' => 'content',
                        'digest' => 'digest'
                    ]
                ]
            ]
        ], $this->news->formatForResponse());
    }
}
