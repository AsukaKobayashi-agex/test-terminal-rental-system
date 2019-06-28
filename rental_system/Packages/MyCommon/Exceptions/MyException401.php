<?php

namespace MyCommon\Exceptions;

class MyException401 extends MyBaseException
{
    protected $_status_code = 401;

    public function __construct(array $info = [])
    {
        $this->_json_exception_info = $info;
    }

    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'UNAUTHORIZED',
                'message' => '未認証',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }
}