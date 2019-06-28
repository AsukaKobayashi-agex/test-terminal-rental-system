<?php

namespace MyCommon\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;

class MyCheckForMaintenanceMode
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    protected $_excludePaths = [
        'api_new/',
        'company/api_new/',
        'cs/api/',
        'api/works_app/',
    ];

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \MyCommon\Exceptions\MyExceptionMaintenance
     */
    public function handle($request, Closure $next)
    {
        if($this->_isExcludePath($request->path())) {
            return $next($request);
        }

        if ((!config('my.maintenance.OPEN_SITE_COMPANY') && !$this->_isAccessPermitIPForCompany())
            || (!config('my.maintenance.OPEN_SITE_CS') && !$this->_isAccessPermitIPForCs())) {

            throw new \MyExceptionMaintenance();
        }

        return $next($request);
    }

    /**
     * メンテナンス画面表示の対象外かどうか
     *
     * @param string $path
     * @return bool
     */
    private function _isExcludePath(string $path)
    {
        foreach($this->_excludePaths as $excludePath) {
            if(Str::startsWith($path, $excludePath)) {
                return true;
            }
        }

        return false;
    }

    /**
     * カンパニー画面にアクセス可能なIPアドレスであるか確認する
     *
     * @return TRUE - 許可する / FALSE - 許可しない
     */
    private function _isAccessPermitIPForCompany()
    {
        return $this->_isAccessPermitIP(config('my.maintenance.PERMIT_ACCESS_IP_COMPANY'));
    }

    /**
     * CS画面にアクセス可能なIPアドレスであるか確認する
     *
     * @return TRUE - 許可する / FALSE - 許可しない
     */
    private function _isAccessPermitIPForCs()
    {
        return $this->_isAccessPermitIP(config('my.maintenance.PERMIT_ACCESS_IP_CS'));
    }

    /**
     * アクセスしたIPアドレスが許可するIPアドレス群に含まれるかを確認する
     *
     * @param  $permitIPAddresses 許可するIPアドレス群(,で区切る)
     * @return TRUE - 許可する / FALSE - 許可しない
     */
    private function _isAccessPermitIP($permitIPAddresses)
    {
        if ($permitIPAddresses == "") {
            return FALSE;
        }

        // アクセスしているIPアドレスを取得する
        if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $xFowardedFor = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $ipAddress = explode(',', $xFowardedFor);
        } else {
            $ipAddress = $_SERVER["REMOTE_ADDR"];
        }

        // 許可するIPアドレスを
        $permitIPList = explode(',', $permitIPAddresses);

        foreach ($permitIPList as $permitIP) {
            if (preg_match('/\//', $permitIP)) {
                list($network, $mask_bit_len) = explode('/', $permitIP);
                if ($this->inCIDR($ipAddress, $network, $mask_bit_len)) {
                    return TRUE;
                }
            } else {
                if ($this->eqIPAddress($ipAddress, $permitIP)) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    /**
     * 同じIPアドレスか確認する
     *
     * @return TRUE / FALSE
     */
    protected function eqIPAddress($ip, $permitIP)
    {
        // X-FORWARDED-FOR
        if(is_array($ip)) {
            foreach($ip as $ip_address) {
                if($this->eqIPAddress($ip_address, $permitIP)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        return $ip === $permitIP;
    }

    /**
     * 同じクラス(ネットワーク)か確認する
     *
     * @return TRUE / FALSE
     */
    protected function inCIDR($ip, $network, $mask_bit_len)
    {
        // X-FORWARDED-FOR
        if(is_array($ip)) {
            foreach($ip as $ip_address) {
                if($this->inCIDR($ip_address, $network, $mask_bit_len)) {
                    return TRUE;
                }
            }
            return FALSE;
        }

        $host = 32 - $mask_bit_len;
        $net = ip2long($network) >> $host << $host;
        $ip_net = ip2long($ip) >> $host << $host;
        return $net === $ip_net;
    }
}