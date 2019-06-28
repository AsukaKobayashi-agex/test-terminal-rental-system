<?php

namespace MyCommon\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MyCommon\Libraries\Utils\RequestUtils;

/**
 * Class DebugbarEnabling
 * デバッグバーの表示設定
 * ※APIやコンソールでは呼び出さないこと
 * @package MyCommon\Http\Middleware
 */
class DebugbarEnabling
{
    public function handle(Request $request, Closure $next)
    {
        $this->_enable();
        return $next($request);
    }

    protected function _enable()
    {
        if ($this->_isEnableDebugbar()) {
            \Debugbar::enable();
        } else {
            \Debugbar::disable();
        }
    }

    protected function _isEnableDebugbar()
    {
        //===============================================
        // ローカル環境ではデバッグ表示する
        //===============================================
        if (app()->isLocal()) {
            return true;
        }

        //===============================================
        // ほかの環境（dev/test/production）は、特定IPアドレスからのアクセス時にデバッグ表示
        //===============================================
        $conf = config('my.debug.DEBUGBAR_ENABLING_REMOTE_IP');
        $enablingIps = explode(',', $conf);

        $utils = new RequestUtils();
        $remoteIp = $utils->getRemoteIp();

        foreach($enablingIps as $enablingIp)
        {
            if ($enablingIp == $remoteIp) {
                return true;
            }
        }

        return false;
    }
}