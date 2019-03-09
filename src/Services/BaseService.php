<?php

namespace ShaoZeMing\AliVod\Services;


use ShaoZeMing\Aliyun\Core\DefaultAcsClient;
use ShaoZeMing\Aliyun\Core\Profile\DefaultProfile;

class BaseService
{


    public $client;

    /**
     * @var
     */
    public $config;
    /**
     * @var
     */
    public $accessKeyID;
    /**
     * @var
     */
    public $accessKeySecret;

    /**
     * @var
     */
    public $regionId;

    /**
     * @var
     */
    public $timeout;

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    public $acceptFormat;


    /**
     * BaseService constructor.
     * @param null $config
     * @param string $securityToken 如果是设置了sts模式，传入这个参数
     */
    public function __construct($config=null,$securityToken='')
    {

        $this->setConfig($config);
        if ($this->type == 'sts') {
            $this->client = $this->initVodSTSClient($securityToken);
        } else {
            $this->client = $this->initVodClient();
        }

    }

    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @return DefaultAcsClient
     */
    public function initVodClient()
    {

        $profile = DefaultProfile::getProfile($this->regionId, $this->accessKeyID, $this->accessKeySecret);
        return new DefaultAcsClient($profile);
    }


    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $securityToken
     * @return DefaultAcsClient
     */
    public function initVodSTSClient($securityToken)
    {
        $profile = DefaultProfile::getProfile($this->regionId, $this->accessKeyID, $this->accessKeySecret, $securityToken);
        return new DefaultAcsClient($profile);
    }


    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $config
     */
    public function setConfig($config)
    {
        $this->config = $config ?: include dirname(__DIR__) .  DIRECTORY_SEPARATOR.'config.php';

        $this->accessKeyID = $this->config['vod']['AccessKeyID'];
        $this->accessKeySecret = $this->config['vod']['AccessKeySecret'];
        $this->regionId = $this->config['vod']['regionId'];
        $this->timeout = $this->config['vod']['timeout'];
        $this->type = $this->config['vod']['type'];
        $this->acceptFormat = $this->config['vod']['acceptFormat'];


    }

}
