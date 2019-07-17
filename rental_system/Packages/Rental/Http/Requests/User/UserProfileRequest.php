<?php

namespace Rental\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'name' => 'min:1|max:50',
            'address' => 'email|min:1|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
            'address' => 'メールアドレス'
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'ユーザー名は最大50文字です',
            'name.min' => 'ユーザー名を入力してください',
            'address.min' => 'メールアドレスを入力してください',
            'address.max' => 'メールアドレスは最大100文字です',
            'address.email' => 'メールアドレスを入力してください'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
