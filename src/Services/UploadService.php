<?php

namespace ShaoZeMing\AliVod\Services;


use ShaoZeMing\AliVod\SDK\CreateUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\RefreshUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\UploadMediaByURLRequest;

class UploadService extends BaseService
{


    /**获取视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $title
     * @param $filename
     * @param $desc
     * @param $coverUrl
     * @param array $tags
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    public function createUploadVideo($title,$filename,$desc,$coverUrl,array $tags=[]) {
        $request = new CreateUploadVideoRequest();
        $request->setTitle($title);
        $request->setFileName($filename);
        $request->setDescription($desc);
        $request->setCoverURL($coverUrl);
        $tags = implode(',',$tags);
        $request->setTags($tags);
        $request->setAcceptFormat('JSON');
        $uploadInfo =   $this->client->getAcsResponse($request);

        return $uploadInfo;
    }


    /**
     * 刷新视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
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
     * @param $url
     * @param $title
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
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
