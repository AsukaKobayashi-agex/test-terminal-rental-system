<?php

namespace Rental\Http\Requests\Admin\Edit;

use Illuminate\Foundation\Http\FormRequest;

class EditPcRequest extends FormRequest
{
    protected $_inputs = [];

    public function all($keys = null)
    {
        if (!empty($this->_inputs)) {
            return $this->_inputs;
        }

        $inputs = parent::all();

        if($this->filled('memo')) {

            $inputs['memo'] = preg_replace("/\r\n/","",$this->input('memo'));

        }

        if($this->filled('admin_memo')) {

            $inputs['admin_memo'] = preg_replace("/\r\n/","",$this->input('admin_memo'));

        }

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
            'os_version' => 'required|max:50',
            'device_name' => 'required|max:100',
            'pc_account_name' => 'max:100',
            'mail_address' => 'max:100',
            'device_img' => 'file|mimes:jpeg|max:3000',
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
            'os_version.required' =>'OSバージョンを入力してください',
            'os_version.max' =>'OSバージョンは50文字以内で記入してください',
            'device_name.required' =>'端末名を入力してください',
            'device_name.max' =>'端末名は100文字以内で記入してください',
            'pc_account_name.max' =>'コンピュータ名は100文字以内で記入してください',
            'mail_address.max' =>'メールアドレスは100文字以内で記入してください',
            'device_img.max' => '端末画像のサイズは3000KBまでです',
            'device_img.file' => '画像のアップロードに失敗しました',
            'device_img.mimes' => 'アップロードできるのはJPEG形式の画像のみですｓ',
            'memo.max' =>'備考は1000文字以内で記入してください',
            'admin_memo.max' =>'備考は1000文字以内で記入してください'
        ];
    }

    // ----------------------------------------------------

    protected function _format($inputs)
    {
        $rules = [
            'pc_account_name' => ['nullToEmpty', 'dependedCharConvert'],
            'mail_address' => ['nullToEmpty', 'mailFormat'],
            'memo' => ['nullToEmpty', 'dependedCharConvert'],
            'admin_memo' => ['nullToEmpty', 'dependedCharConvert']
        ];

        return \Format::format($inputs, $rules);
    }
}
