<?php

namespace ShaoZeMing\AliVod;

class VodService
{


    public $client;


    public function __construct($type='access',$conf=null){

        $config = $conf?: ['AccessKeyID'=>'xxxx','AccessKeySecret'=>'xxxxxx'];

        if($type=='sts' && $conf){
            $this->client =$this->initVodSTSClient($config['AccessKeyID'],$config['AccessKeySecret'],$config['securityToken']);
        }else{
            $this->client =$this->initVodClient($config['AccessKeyID'],$config['AccessKeySecret']);
        }

    }

    public function initVodClient($accessKeyId, $accessKeySecret) {

        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);
        return new \DefaultAcsClient($profile);
    }


    public function initVodSTSClient($accessKeyId, $accessKeySecret, $securityToken) {
        $regionId = 'cn-shanghai';  // 点播服务接入区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret, $securityToken);
        return new \DefaultAcsClient($profile);
    }


    /**
     * 获取视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    public function createUploadVideo() {
        $request = new CreateUploadVideoRequest();
        $request->setTitle("Sample Title");
        $request->setFileName("videoFile.mov");
        $request->setDescription("Video Description");
        $request->setCoverURL("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png");
        $request->setTags("tag1,tag2");
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
     * @param null $url
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    public  function uploadMediaByURL($url = null) {
        $request = new UploadMediaByURLRequest();
        $url =$url?: "http://tb-video.bdstatic.com/tieba-movideo/575421_0ac5cf0333a599a1627fca08177400a1_2fee83eb31d9.mp4";
        $request->setUploadURLs($url);
        $uploadMetadataList = array();
        $uploadMetadata = array();
        $uploadMetadata["SourceUrl"] = $url;
        $uploadMetadata["Title"] = "贴吧拉去的一个视频";
        $uploadMetadataList[] = $uploadMetadata;
        $request->setUploadMetadatas(json_encode($uploadMetadataList));
        return $this->client->getAcsResponse($request);

    }


}
