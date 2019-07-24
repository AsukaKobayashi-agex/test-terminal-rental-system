<?php

namespace Rental\Http\Requests\Admin\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $_inputs = [];

    public function all($keys = null)
    {
        if (!empty($this->_inputs)) {
            return $this->_inputs;
        }

        $inputs = parent::all();

        // Format
        $this->_inputs = $this->_format($inputs);
        return $this->_inputs;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address'=> 'required|max:100',
            'password'=>'required|min:4|max:50'
        ];
    }

    public function attributes()
    {
        return [
            'address'=> 'メールアドレス',
            'password'=>'パスワード'
        ];
    }

    public function messages()
    {
        return [
            'address.required'=> 'メールアドレスを入力してください',
            'address.max'=> 'メールアドレスは100文字以内で入力してください',
            'password.required'=>'パスワードを入力してください',
            'password.min'=>'パスワードは4文字以上です',
            'password.max'=>'パスワードは50文字以内で入力してください'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
