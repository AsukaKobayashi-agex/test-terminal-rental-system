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
            'address' => 'min:1|email|max:100',
            'division_id' => 'numeric',
            'group_id' => 'numeric'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
            'address' => 'メールアドレス',
            'division_id' => '事業部',
            'group_id' => 'グループ'

        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'ユーザー名は最大50文字です',
            'name.min' => 'ユーザー名を入力してください',
            'address.min' => 'メールアドレスを入力してください',
            'address.max' => 'メールアドレスは最大100文字です',
            'address.email' => 'メールアドレスを入力してください',
            'division_id.numeric' => '事業部を選択してください',
            'group_id.numeric' => 'グループを選択してください'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
