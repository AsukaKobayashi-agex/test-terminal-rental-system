<?php

namespace MyCommon\Libraries;

class Format
{
    public function format($params, $rules)
    {
        foreach($rules as $key => $format_methods) {

            if (strpos($key, '.') !== FALSE) {
                // formatパラメータに配列が含まれる場合
                $keys = explode('.', $key);
                $this->_formatMultipleParameter($params, $keys, 0, count($keys)-1, $format_methods);

            } else {
                $this->_formatSingleParameter($params, $key, $format_methods);

            }
        }

        return $params;
    }

    // --------------------------------------------------------------------

    protected function _formatMultipleParameter(&$params, $keys, $key_index, $last_key_index, $format_methods)
    {
        if (!isset($keys[$key_index])) {
            return;
        }
        if ($keys[$key_index] === '*') {
            if ($key_index == $last_key_index) {
                foreach ($format_methods as $format_method) {
                    $params = $this->_execFormatMethod($format_method, $params);
                }
                return;
            }

            if (isset($keys[($key_index + 1)]) && $keys[($key_index + 1)] === '*') { // 次の階層がワイルドカードの場合
                foreach ($params as &$target) {
                    $this->_formatMultipleParameter($target, $keys, ($key_index + 1), $last_key_index, $format_methods);
                }
                return;
            } else {
                $this->_formatMultipleParameter($params, $keys, ($key_index + 1), $last_key_index, $format_methods);
                return;
            }
        } else {
            if (!array_has($params, $keys[$key_index])) {
                return;
            }

            if ($key_index == $last_key_index) {
                $this->_formatSingleParameter($params, $keys[$key_index], $format_methods);
                return;
            }

            if (isset($keys[($key_index + 1)]) && $keys[($key_index + 1)] === '*') { // 次の階層がワイルドカードの場合
                $targets = array_get($params, $keys[$key_index]);
                if (is_array($targets) && ($key_index != $last_key_index)) {
                    foreach ($targets as &$target) {
                        $this->_formatMultipleParameter($target, $keys, ($key_index + 1), $last_key_index, $format_methods);
                    }
                }
                array_set($params, $keys[$key_index], $targets);
                return;
            } else {
                $target = array_get($params, $keys[$key_index]);
                $this->_formatMultipleParameter($target, $keys, ($key_index + 1), $last_key_index, $format_methods);
                array_set($params, $keys[$key_index], $target);
                return;
            }
        }
    }

    protected function _formatSingleParameter(&$params, $key, $format_methods)
    {
        if (!array_has($params, $key)) {
            return;
        }

        $param = array_get($params, $key);

        // 整形
        foreach($format_methods as $format_method) {
            $param = $this->_execFormatMethod($format_method, $param);
        }
        // 整形した値をセット
        array_set($params, $key, $param);
        return;
    }

    protected function _execFormatMethod($format_method, $param)
    {
        $ret = $param;
        if (!function_exists($format_method)) {
            return $ret;
        }

        $ret = $format_method($param);
        return $ret;
    }
}