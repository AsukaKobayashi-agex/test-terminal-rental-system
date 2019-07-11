<?php

namespace Rental\Http\Requests\Admin;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class AddChargerRequest extends FormRequest
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
            'charger_name' => 'required|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'charger_name' => '充電器名'
        ];
    }

    public function messages()
    {
        return [
            'charger_name.required' =>'充電器名を入力してください',
            'charger_name.max' =>'充電器名は100文字以内で記入してください'
        ];

    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
