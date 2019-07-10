<?php

namespace Rental\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ReturnRequest extends FormRequest
{
    protected $_inputs = [];

    public function all($keys = null)
    {
        if (!empty($this->_inputs)) {
            return $this->_inputs;
        }

        //$inputs = $this->old();
        //preDump($inputs,1);
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
        ];
    }


    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
