<?php

namespace WeWork\Tests\Message;

use WeWork\Message\TextCard;
use WeWork\Tests\TestCase;

class TextCardTest extends TestCase
{
    /**
     * @var TextCard
     */
    protected $textCard;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->textCard = new TextCard('title', 'description', 'url', 'btntxt');
    }

    /**
     * @return void
     */
    public function testFormatForResponse()
    {
        $this->assertEquals([
            'msgtype' => 'textcard',
            'textcard' => [
                'title' => 'title',
                'description' => 'description',
                'url' => 'url',
                'btntxt' => 'btntxt'
            ]
        ], $this->textCard->formatForResponse());
    }
}
