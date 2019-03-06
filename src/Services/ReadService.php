<?php

namespace ShaoZeMing\AliVod\Services;


use ShaoZeMing\AliVod\SDK\CreateUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\GetPlayInfoRequest;
use ShaoZeMing\AliVod\SDK\GetVideoPlayAuthRequest;
use ShaoZeMing\AliVod\SDK\RefreshUploadVideoRequest;
use ShaoZeMing\AliVod\SDK\UploadMediaByURLRequest;

class ReadService extends BaseService
{


    /**
     * 获取视频播放详细信息
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    function getPlayInfo($videoId) {
        $request = new GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout(3600*24);
        $request->setAcceptFormat('JSON');
        $playInfo = $this->client->getAcsResponse($request);
        return $playInfo;
    }


    /**
     * 获取播放凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @return mixed|\SimpleXMLElement
     * @throws \ClientException
     * @throws \ServerException
     */
    function getPlayAuth($videoId) {
        $request = new GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout(3600);
        $request->setAcceptFormat('JSON');
        $playAuth  = $this->client->getAcsResponse($request);

        print($playAuth->PlayAuth."\n");
        print_r($playAuth->VideoMeta);
        return $playAuth;
    }

}
