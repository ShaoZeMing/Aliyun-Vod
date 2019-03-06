<?php
/**
 *  TestSms.php
 *
 * @author szm19920426@gmail.com
 * $Id: TestSms.php 2017-08-17 上午10:08 $
 */

namespace ShaoZeMing\AliVod\Test;
use PHPUnit\Framework\TestCase;
use ShaoZeMing\AliVod\VodService;


class AliVodTest extends TestCase
{
    protected $instance;

    public function setUp()
    {

//        $file =  dirname(__DIR__) .'/config/translate.php';
//        $config = include($file);
            $this->instance = new VodService();
    }


    public function testVodManager()
    {
        $this->assertInstanceOf(VodService::class, $this->instance);
    }


    public function testPush()
    {
        echo PHP_EOL."后去上传后的地址和token 中....".PHP_EOL;
        try {
//            $result =  $this->instance->createUploadVideo();

            $result =  $this->instance->uploadMediaByURL();

            print_r($result);
            return $result;
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err.PHP_EOL;

        }
    }
}
