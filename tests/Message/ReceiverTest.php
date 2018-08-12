<?php

namespace WeWork\Tests\Message;

use WeWork\Message\Receiver;
use WeWork\Tests\TestCase;

class ReceiverTest extends TestCase
{
    /**
     * @var Receiver
     */
    protected $receiver;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->receiver = new Receiver();
    }

    /**
     * @param $user
     * @param $expected
     * @return void
     *
     * @dataProvider setProvider
     */
    public function testSetUser($user, $expected)
    {
        $this->receiver->setUser($user);

        $this->assertEquals(['touser' => $expected], $this->receiver->get());
    }

    /**
     * @param $party
     * @param $expected
     * @return void
     *
     * @dataProvider setProvider
     */
    public function testSetParty($party, $expected)
    {
        $this->receiver->setParty($party);

        $this->assertEquals(['toparty' => $expected], $this->receiver->get());
    }

    /**
     * @param $tag
     * @param $expected
     * @return void
     *
     * @dataProvider setProvider
     */
    public function testSetTag($tag, $expected)
    {
        $this->receiver->setTag($tag);

        $this->assertEquals(['totag' => $expected], $this->receiver->get());
    }

    /**
     * @return array
     */
    public function setProvider()
    {
        return [
            ['foo', 'foo'],
            [['foo', 'bar'], 'foo|bar']
        ];
    }
}
