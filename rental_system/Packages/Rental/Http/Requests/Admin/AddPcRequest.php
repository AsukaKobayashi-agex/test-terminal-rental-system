<?php

namespace Rental\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddPcRequest extends FormRequest
{
    protected $_input = [];

    public function  all($keys = null)
    {
        if(!empty($this->_inputs)){
            return $this->_inputs;
        }

        $inputs = parent::all();

        $this->_inputs = $this->_format($inputs);
        return $this->_inputs;
    }

    public function  authorize()
    {
        return true;
    }

    public function  rules()
    {
        return[
            'device_name' => 'required|max:100',
            'pc_account_name' => 'required|max:100',
            'mail_address' => 'required|max:100',
            'memo' => 'max:1000',
            'admin_memo' => 'max:1000'
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
            'device_name.required' =>'端末名を入力してください',
            'device_name.max' =>'端末名は100文字以内で記入してください',
            'pc_account_name.required' =>'コンピュータ名を入力してください',
            'pc_account_name.max' =>'コンピュータ名は100文字以内で記入してください',
            'mail_address.required' =>'メールアドレスを入力してください',
            'mail_address.max' =>'メールアドレスは100文字以内で記入してください',
            'memo.max' =>'備考は1000文字以内で記入してください',
            'admin_memo.max' =>'備考は1000文字以内で記入してください'
        ];
    }

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs,$rules);
    }
}

