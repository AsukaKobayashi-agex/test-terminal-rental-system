<?php

namespace Rental\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DeviceMobileRequest extends FormRequest
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
            'search_word' => 'max:100',
            'os_version' => 'max:50'
        ];
    }

    public function attributes()
    {
        return [
            'search_word' => '検索ワード',
            'os_version' => 'OSバージョン'
        ];
    }

    public function messages()
    {
        return [
            'search_word.max' => '検索ワード : 文字数が多すぎます(最大：半角100文字)',
            'os_version.max' => 'OSバージョン : 文字数が多すぎます(最大：半角50文字)'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
