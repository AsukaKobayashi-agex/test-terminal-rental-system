<?php

namespace Rental\Http\Requests\Admin\Index;

use Illuminate\Foundation\Http\FormRequest;

class IndexPcRequest extends FormRequest
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
            'search_id' => 'max:11',
            'search_word' => 'max:100',
            'os_version' => 'max:50',
            'search_account' => 'max100'
        ];
    }

    public function attributes()
    {
        return [
            'search_id' => '検索ID',
            'search_word' => '検索ワード',
            'os_version' => 'OSバージョン',
            'search_account' => 'PCアカウント名'
        ];
    }

    public function messages()
    {
        return [
            'search_id.max' => '検索文字数が多すぎます(最大11文字)',
            'search_word.max' => '検索ワード : 文字数が多すぎます(最大：100文字)',
            'os_version.max' => 'OSバージョン : 文字数が多すぎます(最大：50文字)',
            'search_account' => 'PCアカウント名 : 文字数が多すぎます(最大：100文字)'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
