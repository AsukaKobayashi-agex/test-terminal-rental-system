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
        return [];
    }

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs,$rules);
    }
}



