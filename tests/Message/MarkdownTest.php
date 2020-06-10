<?php

namespace WeWork\Tests\Message;

use WeWork\Message\Markdown;
use WeWork\Tests\TestCase;

class MarkdownTest extends TestCase
{
    /**
     * @var Markdown
     */
    protected $markdown;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->markdown = new Markdown('content');
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
