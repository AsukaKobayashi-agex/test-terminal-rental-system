<?php

namespace MyCommon\Libraries\Validators;

use \Illuminate\Validation\Validator;

class CommonValidator extends Validator
{
    /**
     * EメールアドレスのValidate
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMyEmail($attribute, $value, $parameters)
    {
        //メールアドレス全体の長さは254文字以下（最大文字列長のValidationをしていない場合のみチェック）
        if (!$this->_hasMaxRule($attribute) && strlen($value) > 254) {
            return false;
        }

        $result = (!preg_match("/^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/ix", $value))? false : true;
        if (!$result) {
            return false;
        }

        // ＠の後ろのチェック
        $array = explode('@', $value);
        if (count($array) == 2) {
            $tempStr = $array[1];
            // ＠の後ろに「..」「.-」「-.」がないかチェック
            if (preg_match("/\.\.|\.-|-\./", $tempStr)) {
                return false;
            }

            //ラベル(ピリオド(.)で区切られた部分)が63文字以下かチェック
            $arrayForLabelLengthCheck = explode('.',$tempStr);
            foreach($arrayForLabelLengthCheck as $label){
                if(strlen($label) > 63){
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Eメールアドレス(ソフトバンクペイメント用)のValidate
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMyEmailSbps($attribute, $value, $parameters)
    {
        if (preg_match("/[^A-Za-z0-9*\-_@ .]/", $value)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 最大文字列長のValidationルールが設定されているか
     * @param $attribute
     * @return bool
     */
    private function _hasMaxRule($attribute)
    {
        $rules = array_get($this->rules, $attribute);
        foreach($rules as $rule) {
            if (strpos($rule, 'max') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * カナチェック
     * 入力文字列がすべてカナであれば TRUE
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateKana($attribute, $value, $parameters)
    {
        // カナ文字列定義
        $pattern = "/[^ヴガギグゲゴザジズゼゾダヂヅデドバビブベボパピプペポ" .
            "アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフ".
            "ヘホマミムメモヤユヨラリルレロワヲンァィゥェォャュョッー゛゜";
        $pattern = $pattern . "]/u";
        return (preg_match($pattern, $value) ? FALSE : TRUE);
    }

    /**
     * ログインパスワードのチェック
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validatePassword($attribute, $value, $parameters)
    {
        if (preg_match('/^[a-z0-9@\.\/_\-\?!%#$&\*=\~]+$/i', $value) > 0) {
            return true;
        }
        return false;
    }

    /**
     * 文字列長Validation（改行除去後に判定）
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMyMax($attribute, $value, $parameters)
    {
        $maxLen = array_get($parameters, 0, '0');
        $maxLen = intval($maxLen);

        // 0 は比較のしようが無いので、ここで終わり
        if ($maxLen == 0) {
            return true;
        }

        // 改行除去後に指定の文字列長以下ならOK
        if ($this->strLenRemoveCRLF($value) <= $maxLen) {
            return true;
        }
        return false;
    }

    /**
     * 文字列長Validation（改行除去後に判定）
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMyMin($attribute, $value, $parameters)
    {
        $minLen = array_get($parameters, 0, '0');
        $minLen = intval($minLen);

        // 0 は比較のしようが無いので、ここで終わり
        if ($minLen == 0) {
            return true;
        }

        // 改行除去後に指定の文字列長以上ならOK
        if ($this->strLenRemoveCRLF($value) >= $minLen) {
            return true;
        }
        return false;
    }

    /**
     * 最小～最大文字列長Validation（改行除去後に判定）
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMyBetween($attribute, $value, $parameters)
    {
        $minLen = array_get($parameters, 0, '0');
        $minLen = intval($minLen);
        $maxLen = array_get($parameters, 1, '0');
        $maxLen = intval($maxLen);

        // 0 は比較のしようが無いので、ここで終わり
        if ($minLen == 0 || $maxLen == 0) {
            return true;
        }

        // 改行除去後に指定の文字列長間ならOK
        $len = $this->strLenRemoveCRLF($value);
        if ($len >= $minLen && $len <= $maxLen) {
            return true;
        }

        return false;
    }

    /**
     * 文字列長Validationのエラーメッセージ（ルール my_max）
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     * @return mixed
     */
    protected function replaceMyMax($message, $attribute, $rule, $parameters)
    {
        return $this->replaceMax($message, $attribute, $rule, $parameters);
    }

    /**
     * 文字列長Validationのエラーメッセージ（ルール max）
     * @param string $message
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return mixed
     */
    protected function replaceMax($message, $attribute, $rule, $parameters)
    {
        $value = $this->getValue($attribute);
        if (is_string($value)) {
            $len = $this->strLenRemoveCRLF($value);

            $search = [':max', ':len'];
            $replace = [array_get($parameters, 0), $len];

            return str_replace($search, $replace, $message);
        } else {
            return parent::replaceMax($message, $attribute, $rule, $parameters);
        }
    }

    /**
     * 文字列長Validationのエラーメッセージ（ルール my_min）
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     * @return mixed
     */
    protected function replaceMyMin($message, $attribute, $rule, $parameters)
    {
        return $this->replaceMin($message, $attribute, $rule, $parameters);
    }

    /**
     * 文字列長Validationのエラーメッセージ（ルール min）
     * @param string $message
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return mixed
     */
    protected function replaceMin($message, $attribute, $rule, $parameters)
    {
        $value = $this->getValue($attribute);
        if (is_string($value)) {
            $len = $this->strLenRemoveCRLF($value);

            $search = [':min', ':len'];
            $replace = [array_get($parameters, 0), $len];

            return str_replace($search, $replace, $message);
        } else {
            return parent::replaceMin($message, $attribute, $rule, $parameters);
        }
    }

    protected function strLenRemoveCRLF($str)
    {
        $replaced = str_replace(array("\r\n","\n","\r"), '', $str);
        return mb_strlen($replaced);
    }

    /**
     * 対象年齢比較
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function validateMyAge($attribute, $value)
    {
        // 入力の取得
        $max_age = $this->getValue('max_age');
        $min_age = $this->getValue('min_age');
        if($max_age < $min_age)return false;
        return true;
    }

    /**
     * 半角数字 & ハイフン
     * @param $value
     * @return boolean
     */
    public function validateNumericHyphen($attribute, $value, $parameters)
    {
        return preg_match('/[^0-9\-]/', $value) ? FALSE : TRUE;
    }
}