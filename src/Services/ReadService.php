<?php

namespace ShaoZeMing\AliVod\Services;


use ShaoZeMing\AliVod\SDK\GetPlayInfoRequest;
use ShaoZeMing\AliVod\SDK\GetVideoPlayAuthRequest;

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
    function getPlayInfo($videoId, $timeout = null)
    {
        $this->timeout = $timeout?:$this->timeout;
        $request = new GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout($this->timeout);
        $request->setAcceptFormat($this->acceptFormat);
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
    function getPlayAuth($videoId, $timeout = null)
    {
        $this->timeout = $timeout?:$this->timeout;
        $request = new GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout($this->timeout);
        $request->setAcceptFormat($this->acceptFormat);
        $playAuth = $this->client->getAcsResponse($request);
        return $playAuth;
    }

}
