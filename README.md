# Aliyun Vod for PHP

---
[![](https://travis-ci.org/ShaoZeMing/Aliyun-Vod.svg?branch=master)](https://travis-ci.org/ShaoZeMing/Aliyun-Vod) 
[![](https://img.shields.io/packagist/v/ShaoZeMing/aliyun-vod.svg)](https://packagist.org/packages/shaozeming/aliyun-vod) 
[![](https://img.shields.io/packagist/dt/ShaoZeMing/aliyun-vod.svg)](https://packagist.org/packages/stichoza/shaozeming/aliyun-vod)

> 因为项目驱动，目前只自定义了几个简单的方法，用于视频查询鉴权和视频上传系列接口，比较其他很多功能接口，我个人觉得直接去控制台更好管理。如果你执意要用，那我只能说你很棒棒哦，需要vod其他的api方法调用，可以参考官方SDK文档使用本包进行调用，本包包含官方所有接口文件，composer已自动载入官方SDK,可以参考。Service/下几个文件。


## 同胞兄弟

- [ShaoZeMing/aliyun-vod](https://github.com/ShaoZeMing/Aliyun-Vod)
- [ShaoZeMing/aliyun-sts](https://github.com/ShaoZeMing/Aliyun-Sts)
- [ShaoZeMing/aliyun-core](https://github.com/ShaoZeMing/Aliyun-Core)
- [ShaoZeMing/aliyun-oss](https://github.com/ShaoZeMing/Aliyun-Oss)
- 待续...


## Installing

```shell
$ composer require shaozeming/aliyun-vod -v
```


### configuration 

拷贝项目下`src/config.php`到你项目中，进行配置其中vod。

配置示例代码：

```php

return [

    /*点播配置*/
    'vod' => [
        'AccessKeyID' => '******密码不能给你看******',
        'AccessKeySecret' => '******密码不能给你看******',
        'regionId' => 'cn-shanghai',   // 点播服务接入区域
        'timeout' => '3600',  // 如果是获取签名有效时间为多少
        'type' => 'access',  //类型:access|sts 如果是sts 实例化对象时候需要传入$securityToken
        'acceptFormat' => 'JSON',  //返回数据格式
    ],
];

```


## Example

- 拷贝项目下`src/config.php`到你项目中，进行配置。
```php
use ShaoZeMing\AliVod\Services\ReadService;
use ShaoZeMing\AliVod\Services\UploadService;


 
 
             $config = include 'you_path/config.php';

             $instance = new UploadService($config);


//            $title ='title';
//            $filename= 'filename.mp4';
//            $desc = "这是一个测试视频";
//            $coverUrl='http://www.pptbz.com/pptpic/UploadFiles_6909/201203/2012031220134655.jpg';
//            $tags=['标签1','标签2'];
//            $result =  $instance->createUploadVideo($title,$filename,$desc,$coverUrl, $tags);  //获取视频上传地址和凭证
//            $result =  $instance->refreshUploadVideo($videoId);  //刷新视频上传凭证
//            $result = $instance->uploadMediaByURL($url,$title);  //url 拉去视屏上传
            
            
              $read = new ReadService($config);
              $result =  $read->getPlayAuth('4db8b50cbee04154b9557a4812a27584'); // 获取播放权限参数
//            $result =  $read->getPlayInfo('4db8b50cbee04154b9557a4812a27584'); // 获取播放信息
            
            print_r($result);
            return $result;
       


```

## 使用原生官方sdk接口示例
- 目前只重写了几个接口方便使用，官方这个很多接口没有写，你们要使用可以直接使用原生方法。

```php

use ShaoZeMing\AliVod\SDK\GetPlayInfoRequest;

    /**
     * 获取视频播放详细信息
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @param float|int $timeout
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    function getPlayInfo($videoId, $timeout = 3600 * 24)
    {
        $request = new GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout($timeout);
        $request->setAcceptFormat('JSON');
        $playInfo = $this->client->getAcsResponse($request);
        return $playInfo;
    }


```

## License

MIT

