<?php

namespace MyCommon\Libraries\Utils;

/**
 * Class RequestUtils
 * HTTPリクエスト処理に関するユーティリティ
 * @package MyCommon\Libraries\Utils
 */
class RequestUtils
{
    public function getRemoteIp()
    {
        $remoteIp = \Request::ip();

        $xForwardedFor = \Request::server('HTTP_X_FORWARDED_FOR');
        if ($xForwardedFor != '') {
            $ips = explode(",", $xForwardedFor);
            $remoteIp = array_pop($ips);
        }

        return $remoteIp;
    }
    
    public function getServerName()
    {
        return \Request::server('SERVER_NAME');
    }
    
    public function getUserAgent()
    {
        return \Request::server('HTTP_USER_AGENT');
    }
    
    public function getReffer()
    {
        return \Request::server('HTTP_REFERER');
    }
    
    public function getRequestUri()
    {
        return \Request::server('REQUEST_URI');
    }
    
    public function getRemoteAddr()
    {
        return \Request::server('REMOTE_ADDR');
    }
    
    public function getRemoteHost()
    {
        return \Request::server('REMOTE_HOST');
    }

    public function getScriptName()
    {
        return \Request::server('SCRIPT_NAME');
    }

    public function getServerAddr()
    {
        return \Request::server('SERVER_ADDR');
    }
}