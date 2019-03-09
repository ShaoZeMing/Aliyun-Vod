<?php
/**
 * Created by PhpStorm.
 * User: shaozeming
 * Date: 2019/3/9
 * Time: 11:57 AM
 */

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
