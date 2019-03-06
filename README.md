# Aliyun Vod for PHP

---
[![](https://travis-ci.org/ShaoZeMing/translate.svg?branch=master)](https://travis-ci.org/ShaoZeMing/translate) 
[![](https://img.shields.io/packagist/v/ShaoZeMing/translate.svg)](https://packagist.org/packages/shaozeming/translate) 
[![](https://img.shields.io/packagist/dt/ShaoZeMing/translate.svg)](https://packagist.org/packages/stichoza/shaozeming/translate)

> 因为项目驱动，目前只自定义了几个简单的方法，用于视频查询鉴权和视频上传系列接口，比较其他很多功能接口，我个人觉得直接去控制台更好管理。如果你执意要用，那我只能说你很棒棒哦，需要vod其他的api方法调用，可以参考官方SDK文档使用本包进行调用，本包包含官方所有接口文件，composer已自动载入官方SDK,可以参考。Service/下几个文件。

## Installing

```shell
$ composer require shaozeming/aliyun-vod -v
```

## Example


```php
use ShaoZeMing\AliVod\Services\ReadService;
use ShaoZeMing\AliVod\Services\UploadService;


 
 
 $config = ['AccessKeyID' => '*****秘钥不给你看******', 'AccessKeySecret' => '*****秘钥不给你看******'];
             $instance = new UploadService($config);
             $read = new ReadService($config);


            $title ='title';
            $filename= 'filename.mp4';
            $desc = "这是一个测试视频";
            $coverUrl='http://www.pptbz.com/pptpic/UploadFiles_6909/201203/2012031220134655.jpg';
            $tags=['标签1','标签2'];
//            $result =  $instance->createUploadVideo($title,$filename,$desc,$coverUrl, $tags);  //获取视频上传地址和凭证
//            $result =  $instance->refreshUploadVideo($videoId);  //刷新视频上传凭证
//            $result = $instance->uploadMediaByURL($url,$title);  //url 拉去视屏上传
            
              $result =  $read->getPlayAuth('4db8b50cbee04154b9557a4812a27584'); // 获取播放权限参数
//            $result =  $read->getPlayInfo('4db8b50cbee04154b9557a4812a27584'); // 获取播放信息
            
            print_r($result);
            return $result;
       



```


## License

MIT

