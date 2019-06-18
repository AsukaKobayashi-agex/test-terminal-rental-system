<?php

namespace MyCommon\Libraries\Mail;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\EmailValidation;

class MyEmailValidator extends EmailValidator
{
    public function isValid($email, EmailValidation $emailValidation)
    {
        $validateRegexp = '([a-zA-Z0-9.\/\+%&,|}#"_~:-]+)\@([a-zA-Z0-9_])([a-zA-Z0-9._-]*)\.([a-zA-Z]+)';
        $match = preg_match('/' . $validateRegexp . '/', $email);
        return boolval($match);
    }
}