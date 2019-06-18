<?php

namespace MyCommon\Libraries\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;

class CustomUrlGenerator extends UrlGenerator
{
    const PK_DIGITS = 6;

    protected $_pk;

    public function __construct(UrlGenerator $url)
    {
        parent::__construct($url->routes, $url->request);

        // HTTPS強制
        $this->forceScheme('https');

        $pk = \Request::get('PK');
        if ($this->_isValidPK($pk)) {
            $this->_pk = $pk;
        } else {
            $this->_pk = $this->_generatePkVariable();
        }
    }

    protected function _isValidPK($pk)
    {
        $pattern = '/^[0-9A-F]{' . self::PK_DIGITS . '}$/';
        if ( preg_match($pattern, $pk) ) {
            return true;
        }
        return false;
    }

    private function _generatePkVariable()
    {
        return strtoupper(substr(md5(uniqid(rand())), 0, self::PK_DIGITS));
    }

    public function getPK($leadChar='', $forceReturn=false)
    {
        if (!$forceReturn && !\Auth::guard('company')->check()) {
            return '';
        }
        return $leadChar.'PK='.$this->_pk;
    }

    protected function routeUrl()
    {
        if (! $this->routeGenerator) {
            $this->routeGenerator = new CustomRouteUrlGenerator($this, $this->request);
        }

        return $this->routeGenerator;
    }

    public function to($path, $extra = [], $secure = null)
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        $tail = implode('/', array_map(
            'rawurlencode', (array) $this->formatParameters($extra))
        );

        $root = $this->formatRoot($this->formatScheme($secure));

        list($path, $query) = $this->extractQueryString($path);

        // PK変数を付加する
        $this->_addPkVariable($query);

        $path = $this->format($root, '/'.trim($path.'/'.$tail, '/')).'/';
        return $path.$query;
    }

    protected function _addPkVariable(&$query)
    {
        // ログイン確認
        if (!\Auth::guard('company')->check()) {
            // ログアウト時は何もしない
            return;
        }
        // 既にPK変数が付加されているか
        if ($this->_isIncludedPkVariable($query)) {
            return;
        }
        // PK変数の文字列を取得
        $leadChar = (($query == '') ? '?':'&');
        $pkString = $this->getPK($leadChar);
        $query .= $pkString;
        return;
    }

    protected function _isIncludedPkVariable($query)
    {
        return (strpos($query, 'PK=') !== FALSE);
    }
}