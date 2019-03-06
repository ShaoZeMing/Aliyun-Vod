<?php
/**
 *  TestSms.php
 *
 * @author szm19920426@gmail.com
 * $Id: TestSms.php 2017-08-17 上午10:08 $
 */

namespace ShaoZeMing\AliVod\Test;

use PHPUnit\Framework\TestCase;
use ShaoZeMing\AliVod\Services\ReadService;
use ShaoZeMing\AliVod\Services\UploadService;


class AliVodTest extends TestCase
{
    protected $instance;
    protected $read;

    public function setUp()
    {

//        $file =  dirname(__DIR__) .'/config/translate.php';
//        $config = include($file);

        try {
            $config = ['AccessKeyID' => '******账号不给你看***', 'AccessKeySecret' => '*****密码给你看******'];
            $this->instance = new UploadService($config);
            $this->read = new ReadService($config);
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err . PHP_EOL;
        }
    }


    public function testVodManager()
    {
        $this->assertInstanceOf(UploadService::class, $this->instance);
        $this->assertInstanceOf(ReadService::class, $this->read);
    }


    public function testPush()
    {
        echo PHP_EOL . "后去上传后的地址和token 中...." . PHP_EOL;
        try {
            $title ='title';
            $filename= 'filename.mp4';
            $desc = "这是一个测试视频";
            $coverUrl='http://www.pptbz.com/pptpic/UploadFiles_6909/201203/2012031220134655.jpg';
            $tags=['标签1','标签2'];
//            $result =  $this->instance->createUploadVideo($title,$filename,$desc,$coverUrl, $tags);  //获取视频上传地址和凭证
//            $result =  $this->instance->refreshUploadVideo($videoId);  //刷新视频上传凭证
//            $result = $this->instance->uploadMediaByURL($url,$title);  //url 拉去视屏上传

            $result =  $this->read->getPlayAuth('4db8b50cbee04154b9557a4812a27584'); // 获取播放权限参数
//            $result =  $this->read->getPlayInfo('4db8b50cbee04154b9557a4812a27584'); // 获取播放信息


            print_r($result);
            return $result;
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err . PHP_EOL;

        }
    }
}
