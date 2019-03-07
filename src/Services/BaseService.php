<?php

namespace ShaoZeMing\AliVod\Services;


use ShaoZeMing\AliVod\SDK\CreateUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\RefreshUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\UploadMediaByURLRequest;
use ShaoZeMing\Aliyun\Core\DefaultAcsClient;
use ShaoZeMing\Aliyun\Core\Profile\DefaultProfile;

class BaseService
{


    public $client;


    /**
     * VodService constructor.
     * @param array $config 账号信息 ['AccessKeyID'=>'xxx', 'AccessKeySecret'=>'xxxxxxxxx']
     * @param string $type 类型:access|sts
     * @throws \Exception
     */
    public function __construct(array $config,$type='access'){

        if(!isset($config['AccessKeyID']) ||  !isset($config['AccessKeySecret'])){
            throw new \Exception('config AccessKeyID or AccessKeySecret is empty!');
        }

        if($type=='sts'){
            if(!isset($config['securityToken'])){
                throw new \Exception('sts config securityToken is empty!');
            }
            $this->client =$this->initVodSTSClient($config['AccessKeyID'],$config['AccessKeySecret'],$config['securityToken']);
        }else{
            $this->client =$this->initVodClient($config['AccessKeyID'],$config['AccessKeySecret']);
        }

    }

    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $accessKeyId
     * @param $accessKeySecret
     * @return DefaultAcsClient
     */
    public function initVodClient($accessKeyId, $accessKeySecret) {

        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);
        return new DefaultAcsClient($profile);
    }


    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $securityToken
     * @return DefaultAcsClient
     */
    public function initVodSTSClient($accessKeyId, $accessKeySecret, $securityToken) {
        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret, $securityToken);
        return new DefaultAcsClient($profile);
    }



}
