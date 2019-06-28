<?php

namespace MyCommon\Libraries\Utils;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Guzzleを使ったcURLアクセス用のユーティリティクラス
 * http://docs.guzzlephp.org/en/latest/index.html
 * @package MyCommon\Libraries\Utils
 */
class CurlUtils
{
    protected $baseUri;
    protected $basicId;
    protected $basicPw;

    /**
     *
     */
    public function __construct()
    {
        // extends した先でセットすること
        $this->baseUri = '';
        $this->basicId = '';
        $this->basicId = '';
    }

    /**
     * GETメソッドでURLを叩く。
     * URLからの戻りはjsonを想定。
     * jsonをdecodeした配列を返す。
     * @param string $url
     * @return mixed
     */
    public function get(string $url, array $headers = [], array $query = [])
    {
        $guzzle = $this->_getGuzzleClientInstance();
        $response = $guzzle->get($url ,['headers' => $headers, 'query' => $query]);

        $this->handleErrorResponse($response);
        return $this->decodeContent($response);
    }

    /**
     *
     * POSTメソッドでURLを叩く。
     * URLからの戻りはjsonを想定。
     * jsonをdecodeした配列を返す。
     * @param string $url
     * @param array|null $params
     * @return mixed
     */
    public function post(string $url, array $params = [])
    {
        $guzzle = $this->_getGuzzleClientInstance();
        $response = $guzzle->request('POST', $url, ['form_params' => $params]);

        $this->handleErrorResponse($response);
        return $this->decodeContent($response);
    }

    /**
     * レスポンスエラー時の処理
     * @param $response
     * @param $contents
     */
    protected function handleErrorResponse($response, $contents='')
    {
        if ($response->getStatusCode() != '200') {
            throw new HttpException($response->getStatusCode(), $response->getReasonPhrase());
        }
    }

    /**
     * レスポンス内のコンテンツがjsonならdecodeする。json以外ならコンテンツをそのまま返す。
     * @param $response
     * @return mixed
     */
    protected function decodeContent($response)
    {
        $content = $response->getBody()->getContents();
        if (!isJsonStr($content)) {
            return $content;
        }

        return json_decode($content, true);
    }

    /**
     * cURLアクセス用モジュール Guzzle/Client のインスタンスを返す
     * @return \GuzzleHttp\Client
     */
    protected function _getGuzzleClientInstance()
    {
        $defaultOptions = [];
        $defaultOptions += $this->_optionBaseUri();
        $defaultOptions += $this->_optionAuth();
        $defaultOptions += $this->_optionCurlOpt();
        return new \GuzzleHttp\Client($defaultOptions);
    }

    /**
     * base_uri の設定
     * @return null
     */
    protected function _optionBaseUri()
    {
        if ($this->baseUri == '') {
            return [];
        }

        $data = ['base_uri' => $this->baseUri];
        return $data;
    }

    /**
     * BASIC認証ID/PW
     * @return array|null
     */
    protected function _optionAuth()
    {
        if ($this->basicId == '' || $this->basicPw == '') {
            return [];
        }

        $data = ['auth' => [$this->basicId, $this->basicPw]];
        return $data;
    }

    /**
     * cURLのオプション
     * @return array
     */
    protected function _optionCurlOpt()
    {
        $env = config('app.env');
        $curlOpt = [];
        $curlOpt += [CURLOPT_SSL_VERIFYPEER=>false];

        $data = ['curl' => $curlOpt];
        return $data;
    }
}