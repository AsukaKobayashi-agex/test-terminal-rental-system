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
            'email'=> 'required',
            'password'=>'required|min:4'
        ];
    }

    public function attributes()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
            'email'=> 'メールアドレスを入力してください',
            'password'=>'パスワードは４文字以上です'

        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
