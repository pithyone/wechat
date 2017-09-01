<?php
/**
 * media.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/9/1
 */
require 'bootstrap.php';

$test = $work->setAgentId('test');
$media = $test->media;

// 上传临时素材文件
//var_dump($media->upload('image', '/path/to/file'));

// 获取临时素材文件
//var_dump(file_put_contents(
//    __DIR__.'/../tmp/image.png',
//    $media->get('3J7g_v-QEILvXEEzkN-1CK_X2im4cgteHI0hqH_WzQygLccY1-es6Ki8fRH5WbU5t')
//));
