<?php

namespace WeWork\Tests\Message;

use WeWork\Message\Voice;
use WeWork\Tests\TestCase;

class VoiceTest extends TestCase
{
    /**
     * @var Voice
     */
    protected $voice;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->voice = new Voice('media_id');
    }

    /**
     * @return void
     */
    public function testFormatForReply()
    {
        $this->assertEquals([
            'MsgType' => 'voice',
            'Voice' => [
                'MediaId' => 'media_id'
            ]
        ], $this->voice->formatForReply());
    }

    /**
     * @return void
     */
    public function testFormatForResponse()
    {
        $this->assertEquals([
            'msgtype' => 'voice',
            'voice' => [
                'media_id' => 'media_id'
            ]
        ], $this->voice->formatForResponse());
    }
}
