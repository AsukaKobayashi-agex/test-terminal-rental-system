<?php

namespace Rental\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddSpRequest extends FormRequest
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
            'number' => 'required|max:50',
            'display_size' => 'required|max:100',
            'resolution' => 'required|max:100',
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
            'number.required' =>'電話番号を入力してください',
            'number.max' =>'電話番号は100文字以内で記入してください',
            'display_size.required' =>'画面サイズを入力してください',
            'display_size.max' =>'画面サイズは100文字以内で記入してください',
            'resolution.required' =>'解像度を入力してください',
            'resolution.max' =>'解像度は100文字以内で記入してください',
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



