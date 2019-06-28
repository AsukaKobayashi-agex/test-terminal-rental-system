<?php

namespace MyCommon\Exceptions;

class MyException403 extends MyBaseException
{
    protected $_status_code = 403;

    public function __construct(array $info = [])
    {
        $this->_json_exception_info = $info;
    }

    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'FORBIDDEN',
                'message' => '許可されていないリクエストです。',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }
}