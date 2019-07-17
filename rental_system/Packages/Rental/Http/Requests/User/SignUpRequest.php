<?php

namespace Rental\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'username'=> 'required|max:50',
            'division_id'=> 'required',
            'group_id'=> 'required',
            'address'=> 'email|required|max:100',
            'password'=>'required|min:4|max:50',
            'repeatPassword'=>'same:password'
        ];
    }

    public function attributes()
    {
        return [
            'username'=> '氏名',
            'division_id'=> '事業部',
            'group_id'=> 'グループ',
            'address'=> 'メールアドレス',
            'password'=>'パスワード',
            'repeatPassword'=>'確認用パスワード'
        ];
    }

    public function messages()
    {
        return [
            'username.required'=> '氏名を入力してください',
            'username.max'=> '氏名が長すぎます(最大50文字)',
            'division_id.required'=> '事業部を選択してください',
            'group_id.required'=> 'グループを選択してください',
            'address.required'=> 'メールアドレスを入力してください',
            'address.email'=> 'メールアドレスを入力してください',
            'address.max'=> 'メールアドレスが長すぎます(最大100文字)',
            'password.required'=>'パスワードを入力してください',
            'password.min'=>'パスワードが短すぎます(最低4文字)',
            'password.max'=>'パスワードが長すぎます(最大50文字)',
            'repeatPassword.same'=>'パスワードが一致していません'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
