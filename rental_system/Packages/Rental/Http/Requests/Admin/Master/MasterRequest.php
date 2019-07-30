<?php

namespace Rental\Http\Requests\Admin\Master;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
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
            'app_name' => 'sometimes|required|max:100',
            'software_name' => 'sometimes|required||max:100',
            'carrier_name' => 'sometimes|required||max:100'
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
            'app_name.required' => 'アプリ名を入力してください',
            'app_name.max' => 'アプリ名が長すぎます',
            'carrier_name.required' => 'キャリア名を入力してください',
            'carrier_name.max' => 'キャリア名が長すぎます',
            'software_name.required' => 'ソフトウェア名を入力してください',
            'software_name.max' => 'ソフトウェア名が長すぎます'
        ];

    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
