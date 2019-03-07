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
     * @param float|int $timeout
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    function getPlayInfo($videoId,$timeout=3600*24) {
        $request = new GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout($timeout);
        $request->setAcceptFormat('JSON');
        $playInfo = $this->client->getAcsResponse($request);
        return $playInfo;
    }


    /**
     * 获取播放凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @param int $timeout
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    function getPlayAuth($videoId,$timeout=3600) {
        $request = new GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout($timeout);
        $request->setAcceptFormat('JSON');
        $playAuth  = $this->client->getAcsResponse($request);
        return $playAuth;
    }

}
