<?php

namespace pithyone\wechat\Action;

/**
 * Class Media.
 */
class Media extends Base
{
    const MEDIA_UPLOAD = '/cgi-bin/media/upload';
    const MEDIA_GET = '/cgi-bin/media/get';

    /**
     * 上传临时素材文件
     *
     * @param string $type 媒体文件类型，分别有图片（image）、语音（voice）、视频（video），普通文件(file)
     * @param string $path 文件位置，绝对路径
     *
     * @return mixed
     */
    public function upload($type, $path)
    {
        $this->http->addQuery(['type' => $type]);

        return $this->http->response('UPLOAD', [self::MEDIA_UPLOAD, ['media' => $path]]);
    }

    /**
     * 获取临时素材文件
     *
     * @param string $media_id 媒体文件id
     *
     * @return mixed
     */
    public function get($media_id)
    {
        return $this->http->response('GET', [self::MEDIA_GET, ['media_id' => $media_id]]);
    }
}
