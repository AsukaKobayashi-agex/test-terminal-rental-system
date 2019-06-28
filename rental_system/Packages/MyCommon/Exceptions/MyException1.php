<?php

namespace MyCommon\Exceptions;

class MyException1 extends MyBaseException
{
    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'PARAMETER_SHORTAGE',
                'message' => 'パラメータが不足しています。',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }
}
