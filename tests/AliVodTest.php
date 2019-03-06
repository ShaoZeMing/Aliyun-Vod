<?php
/**
 *  TestSms.php
 *
 * @author szm19920426@gmail.com
 * $Id: TestSms.php 2017-08-17 上午10:08 $
 */

namespace ShaoZeMing\AliVod\Test;

use PHPUnit\Framework\TestCase;
use ShaoZeMing\AliVod\Services\UploadService;


class AliVodTest extends TestCase
{
    protected $instance;

    public function setUp()
    {

//        $file =  dirname(__DIR__) .'/config/translate.php';
//        $config = include($file);

        try {
            $config = ['AccessKeyID' => 'xxxxx', 'AccessKeySecret' => 'xxxxx'];
            $this->instance = new UploadService($config);
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err . PHP_EOL;
        }
    }


    public function testVodManager()
    {
        $this->assertInstanceOf(UploadService::class, $this->instance);
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
            $result =  $this->instance->createUploadVideo($title,$filename,$desc,$coverUrl, $tags);

//            $result = $this->instance->uploadMediaByURL();

            print_r($result);
            return $result;
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err . PHP_EOL;

        }
    }
}
