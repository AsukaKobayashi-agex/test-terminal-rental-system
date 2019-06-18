<?php

namespace MyCommon\Libraries\Masters;

abstract class Master
{
    protected $master = [];
    protected $urlMaster = [];

    public function get($key, $default='')
    {
        return (isset($this->master[$key]) ? $this->master[$key] : $default);
    }

    public function set($key, $val)
    {
        $this->master[$key] = $val;
    }

    public function isEmpty($key)
    {
        return empty($this->master[$key]);
    }

    public function all()
    {
        return $this->master;
    }

    public function getKeys()
    {
        return array_keys($this->master);
    }

    public function getKeysAsString($glue=',')
    {
        return implode($glue, $this->getKeys());
    }

    public function isValidId($id)
    {
        return in_array($id, $this->getKeys());
    }

    public function getUrls()
    {
        return array_values($this->urlMaster);
    }

    public function getUrl($key, $default='')
    {
        return (isset($this->urlMaster[$key]) ? $this->urlMaster[$key] : $default);
    }

    public function getIndexFromUrl($url, $default='')
    {
        foreach ($this->urlMaster as $key => $val) {
            if (strcmp($val, $url) === 0) {
                return $key;
            }
        }
        return $default;
    }

    public function getIndexFromUrlInParticularIndex($url, $particularIndexes=[], $default='')
    {
        foreach ($this->urlMaster as $key => $val) {
            if (in_array($key, $particularIndexes)) {
                if (strcmp($val, $url) === 0) {
                    return $key;
                }
            }
        }
        return $default;
    }
}