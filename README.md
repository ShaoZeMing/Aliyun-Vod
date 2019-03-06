# Aliyun Vod for PHP

---
[![](https://travis-ci.org/ShaoZeMing/translate.svg?branch=master)](https://travis-ci.org/ShaoZeMing/translate) 
[![](https://img.shields.io/packagist/v/ShaoZeMing/translate.svg)](https://packagist.org/packages/shaozeming/translate) 
[![](https://img.shields.io/packagist/dt/ShaoZeMing/translate.svg)](https://packagist.org/packages/stichoza/shaozeming/translate)


## Installing

```shell
$ composer require shaozeming/aliyun-vod -v
```

### configuration 

```php
// config/translate.php

    //使用什么翻译驱动
    // 目前支持这几种: "baidu", "youdao","google"
    /*
     *  默认使用google  google使用的是免费接口爬取，目前能用，为了确保稳定，请配置一个备用服务， 目前只有google和baidu 支持繁体翻译
     */
    'defaults' => [
        'driver' => 'google',   //默认使用google翻译
        'spare_driver' => 'baidu',  // 备用翻译api ,第一个翻译失败情况下，调用备用翻译服务，填写备用翻译api 需要在下面对应的drivers中配置你参数
        'from' => 'zh',   //原文本语言类型 ，目前支持：auto【自动检测】,en【英语】,zh【中文】，jp【日语】,ko【韩语】，fr【法语】，ru【俄文】，pt【西班牙】
        'to' => 'en',     //翻译文本 ：en【英语】,zh【中文】，jp【日语】,ko【韩语】，fr【法语】，ru【俄文】，pt【西班牙】,  
    ],
   
       'drivers' => [
           'baidu' => [
               'base_url' => 'http://api.fanyi.baidu.com/api/trans/vip/translate',
               //App id of the translation api
               'app_id' => '20180611000174972',
               //secret of the translation api
               'app_key' => 'cEXha7w4elaXO23NJ2Tt',
           ],
   
           'youdao' => [
               'base_url' => 'https://openapi.youdao.com/api',
               //App id of the translation api
               'app_id' => '',
               //secret of the translation api
               'app_key' => '',
           ],
   
           'google' => [
               'base_url' => 'http://translate.google.cn/translate_a/single',
               'app_id' => '',
               'app_key' => '',
           ],
       ],


```


## Usage


```php
use ShaoZeMing\Translate\TranslateService;

$config = include($youerpath.'/translate.php')

$obj = new TranslateService($config);
$result = $obj->translate('你知道我对你不仅仅是喜欢');
print_r($result);



```


Example:

```php
 // 动态更改翻译服务商
 $config = include($youerpath.'/translate.php')
 $obj = new TranslateService($config);
 $obj->setDriver('baidu')->translate('你知道我对你不仅仅是喜欢');
 print_r($result);
 //You know I'm not just like you
 
 // 动态更改语种
 
 $from = 'en';
 $to = 'zh';
 $result =  $obj->setDriver('baidu')->setFromAndTo($from,$to)->translate('I love you.');
print_r($result);


```

## License

MIT

