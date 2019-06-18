<?php

namespace MyCommon\Exceptions;

use Exception;

class MyBaseException extends Exception
{
    protected $_status_code = 400;
    protected $_exception_info = [];
    protected $_json_exception_info = [];

    public function __construct(array $info = [])
    {
        if (isset($info['causeList'])) {
            $this->_exception_info['causeList'] = $info['causeList'];
        }
    }

    public function getCauseList()
    {
        if (isset($this->_exception_info['causeList'])) {
            return $this->_exception_info['causeList'];
        }
        return [];
    }

    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'INTERNAL_SERVER_ERROR',
                'message' => 'サーバー側でエラーが発生しました。',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }

    public function getStatusCode()
    {
        return $this->_status_code;
    }
}
