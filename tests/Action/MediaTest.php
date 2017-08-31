<?php
/**
 * MediaTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Media;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class MediaTest.
 */
class MediaTest extends AbstractTestCase
{
    public function testUpload()
    {
        $body = '{"errcode":0,"errmsg":"","type":"image","media_id":"1G6nrLmr5EC3MMb_-zK1dDdzmd0p7cNliYu9V5w7o8K0","created_at":"1380000000"}';
        $work = $this->getWork($body);

        $type = 'image';
        $path = '/path/to/file';
        $res = $work->media->upload($type, $path);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Media::MEDIA_UPLOAD, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($type, $res['options']['query']['type']);
        $this->assertEquals([['name' => 'media', 'contents' => 'abc']], $res['options']['multipart']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testGet()
    {
        $body = '{"errcode":0,"errmsg":"ok"}';
        $work = $this->getWork($body);

        $mediaId = '1G6nrLmr5EC3MMb_-zK1dDdzmd0p7cNliYu9V5w7o8K0';
        $res = $work->media->get($mediaId);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Media::MEDIA_GET, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($mediaId, $res['options']['query']['media_id']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
