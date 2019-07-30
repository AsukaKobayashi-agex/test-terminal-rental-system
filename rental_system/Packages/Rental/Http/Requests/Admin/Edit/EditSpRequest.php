<?php

namespace Rental\Http\Requests\Admin\Edit;

use Illuminate\Foundation\Http\FormRequest;

class EditSpRequest extends FormRequest
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
            'device_name' => 'required|max:100',
            'number' => 'max:50',
            'os_version' => 'required|max:50',
            'mail_address' => 'max:100',
            'display_size' => 'max:100',
            'resolution' => 'max:100',
            'device_img' => 'mimes:jpeg|max:3000',
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
            'number.max' =>'電話番号は100文字以内で記入してください',
            'os_version.max' =>'OSバージョンは50文字以内で記入してください',
            'os_version.required' =>'OSバージョンを入力してください',
            'mail_address.max' =>'メールアドレスは100文字以内で記入してください',
            'display_size.max' =>'画面サイズは100文字以内で記入してください',
            'resolution.max' =>'解像度は100文字以内で記入してください',
            'device_img.mimes' => 'アップロードできるのはJPEG形式の画像のみです',
            'device_img.max' => '端末画像のサイズは3000KBまでです',
            'memo.max' =>'備考は1000文字以内で記入してください',
            'admin_memo.max' =>'備考は1000文字以内で記入してください'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [
            'number' => ['nullToEmpty'],
            'mail_address' => ['nullToEmpty', 'mailFormat'],
            'display_size' => ['nullToEmpty', 'dependedCharConvert'],
            'resolution' => ['nullToEmpty', 'dependedCharConvert'],
            'launch_date' =>['nullToDefaultDate'],
            'memo' => ['nullToEmpty', 'dependedCharConvert'],
            'admin_memo' => ['nullToEmpty', 'dependedCharConvert'],
        ];

        return \Format::format($inputs, $rules);
    }
}
