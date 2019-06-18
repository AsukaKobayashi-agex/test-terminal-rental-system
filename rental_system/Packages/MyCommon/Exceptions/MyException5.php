<?php

namespace MyCommon\Exceptions;

class MyException5 extends MyBaseException
{
    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'NOT_FOUND',
                'message' => '指定されたデータは存在しません。',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }
}
