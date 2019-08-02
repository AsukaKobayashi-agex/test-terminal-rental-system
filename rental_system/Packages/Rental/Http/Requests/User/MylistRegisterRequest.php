<?php

namespace Rental\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MylistRegisterRequest extends FormRequest
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
            'mylist_name' => 'min:1|max:50',
        ];
    }

    public function attributes()
    {
        return [
            'mylist_name' => 'マイリスト名',
        ];
    }

    public function messages()
    {
        return [
            'mylist_name.min' => 'マイリスト名を入力してください',
            'mylist_name.max' => 'マイリスト名が長すぎます(最大:50文字)',
        ];
    }


    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
