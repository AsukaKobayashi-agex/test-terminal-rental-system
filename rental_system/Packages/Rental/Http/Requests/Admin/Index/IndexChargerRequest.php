<?php

namespace Rental\Http\Requests\Admin\Index;

use Illuminate\Foundation\Http\FormRequest;

class IndexChargerRequest extends FormRequest
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
            'search_id' => 'max:11'
        ];
    }

    public function attributes()
    {
        return [
            'search_word' => '検索ワード',
            'search_id' => '検索ID'
        ];
    }

    public function messages()
    {
        return [
            'search_word.max' => '検索ワード : 文字数が多すぎます(最大100文字)',
            'search_id.max' => '検索文字数が多すぎます(最大11文字)'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs, $rules);
    }
}
