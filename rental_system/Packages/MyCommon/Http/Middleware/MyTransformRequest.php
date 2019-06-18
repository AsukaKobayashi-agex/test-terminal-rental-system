<?php

namespace  MyCommon\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class MyTransformRequest extends TransformsRequest
{
    /**
     * リクエスト内容（GET/POST）の共通の変換処理
     * @param string $key
     * @param mixed $value
     * @return string
     */
    protected function transform($key, $value)
    {
        $transformed = $value;

        // 末尾の全半角スペース・改行を除去
        $transformed = is_string($transformed) ? preg_replace('/[ 　\r\n]+$/u', '', $transformed) : $transformed;

        // 機種依存文字の変換
        $transformed = dependedCharConvert($transformed);

        // ほかにも必要な変換があれば
        // ・・・

        return $transformed;
    }
}