<?php

namespace MyCommon\Exceptions;

class MyException2 extends MyBaseException
{
    protected $_validation_errors = [];

    public function setValidationErrors($errors)
    {
        $this->_validation_errors = $errors;
    }

    public function getJsonExceptionInfo()
    {
        if (empty($this->_json_exception_info)) {
            $this->_json_exception_info = [
                'code' => 'VALIDATION_ERROR',
                'message' => 'リクエストが不正です。',
                'data' => $this->_validation_errors
            ];
        }
        return $this->_json_exception_info;
    }
}