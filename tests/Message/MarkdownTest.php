<?php

namespace WeWork\Tests\Message;

use WeWork\Message\Markdown;
use WeWork\Tests\TestCase;

class MarkdownTest extends TestCase
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

        $this->textCard = new Markdown('content');
    }

    /**
     * @return void
     */
    public function testFormatForResponse()
    {
        $this->assertEquals([
            'msgtype'  => 'markdown',
            'markdown' => [
                'content' => 'content'
            ]
        ], $this->textCard->formatForResponse());
    }
}
