<?php

namespace Rental\Http\Requests\User;

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
            'address'=> 'required',
            'password'=>'required|min:4'
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
            'password.required'=>'パスワードを入力してください',
            'password.min'=>'パスワードは半角４文字以上です'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
