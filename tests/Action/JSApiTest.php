<?php
/**
 * JSApiTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class JSApiTest.
 */
class JSApiTest extends AbstractTestCase
{
    public function testGetTicket()
    {
        $work = $this->getWork('{"errcode":0,"errmsg":"ok","ticket":"bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA","expires_in":7200}');
        $this->assertEquals(
            'bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA',
            $work->JSApi->getTicket()
        );
    }

    public function testSign()
    {
        $work = $this->getWork('{"errcode":0,"errmsg":"ok","ticket":"bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA","expires_in":7200}');

        $this->assertInternalType('array', $work->JSApi->sign());
        $this->assertCount(6, $work->JSApi->sign());
    }
}
