<?php

namespace WeWork\Tests\Message;

use WeWork\Message\Video;
use WeWork\Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     * @var Video
     */
    protected $video;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->video = new Video('media_id', 'title', 'description');
    }

    /**
     * @return void
     */
    public function testFormatForReply()
    {
        $this->assertEquals([
            'MsgType' => 'video',
            'Video' => [
                'MediaId' => 'media_id',
                'Title' => 'title',
                'Description' => 'description'
            ]
        ], $this->video->formatForReply());
    }

    /**
     * @return void
     */
    public function testFormatForResponse()
    {
        $this->assertEquals([
            'msgtype' => 'video',
            'video' => [
                'media_id' => 'media_id',
                'title' => 'title',
                'description' => 'description'
            ]
        ], $this->video->formatForResponse());
    }
}
