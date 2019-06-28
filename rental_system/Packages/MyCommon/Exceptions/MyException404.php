<?php

namespace MyCommon\Exceptions;

class MyException404 extends MyBaseException
{
    protected $_status_code = 404;

    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'PAGE_NOT_FOUND',
                'message' => '指定されたページは存在しません。',
                'data' => []
            ];
        }
        return $this->_json_exception_info;
    }
}