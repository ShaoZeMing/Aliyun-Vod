<?php

namespace ShaoZeMing\AliVod;

class VodService
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
     * @return \DefaultAcsClient
     */
    public function initVodClient($accessKeyId, $accessKeySecret) {

        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);
        return new \DefaultAcsClient($profile);
    }


    /**
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $securityToken
     * @return \DefaultAcsClient
     */
    public function initVodSTSClient($accessKeyId, $accessKeySecret, $securityToken) {
        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret, $securityToken);
        return new \DefaultAcsClient($profile);
    }


    /**
     * 获取视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $title
     * @param $filename
     * @param $desc
     * @param $coverUrl
     * @param array $tags
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    public function createUploadVideo($title,$filename,$desc,$coverUrl,array $tags=[]) {
        $request = new CreateUploadVideoRequest();
        $request->setTitle($title);
        $request->setFileName($filename);
        $request->setDescription($desc);
        $request->setCoverURL($coverUrl);
        $request->setTags(implode(',',$tags));
        $request->setAcceptFormat('JSON');
        $uploadInfo =   $this->client->getAcsResponse($request);

        return $uploadInfo;
    }


    /**
     * 刷新视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    public function refreshUploadVideo($videoId) {
        $request = new RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        $refreshInfo =  $this->client->getAcsResponse($request);

        return $refreshInfo;
    }


    /**
     * URL批量拉取上传
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param string $url
     * @param string $title
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    public  function uploadMediaByURL($url,$title) {

        $request = new UploadMediaByURLRequest();
        $request->setUploadURLs($url);
        $uploadMetadataList = array();
        $uploadMetadata = array();
        $uploadMetadata["SourceUrl"] = $url;
        $uploadMetadata["Title"] = $title;
        $uploadMetadataList[] = $uploadMetadata;
        $request->setUploadMetadatas(json_encode($uploadMetadataList));
        return $this->client->getAcsResponse($request);

    }


}
