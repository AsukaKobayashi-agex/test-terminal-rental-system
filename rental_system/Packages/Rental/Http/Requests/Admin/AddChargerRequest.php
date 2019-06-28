<?php

namespace Rental\Http\Requests\Admin;

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
            // todo: validationルールを設定する
        ];
    }

    public function attributes()
    {
        return [
            // todo: 名称を設定する
        ];
    }

    public function messages()
    {
        return [];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
