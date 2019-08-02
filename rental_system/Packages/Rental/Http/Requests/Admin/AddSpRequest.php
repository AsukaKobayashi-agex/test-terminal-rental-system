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

        if($this->filled('memo')) {

            $inputs['memo'] = preg_replace("/\r/","",$this->input('memo'));

        }

        if($this->filled('admin_memo')) {

            $inputs['admin_memo'] = preg_replace("/\r/","",$this->input('admin_memo'));

        }

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
            'number' => 'max:50',
            'os' =>'required',
            'os_version' => 'required|max:50',
            'mobile_type' =>'required',
            'communication_line' =>'required',
            'wifi_line' =>'required',
            'carrier_id' =>'required',
            'sim_card' =>'required',
            'charger_type' =>'required',
            'mail_address' => 'max:100',
            'display_size' => 'max:100',
            'resolution' => 'max:100',
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
            'device_name.required' =>'端末名を入力してください',
            'device_name.max' =>'端末名は100文字以内で記入してください',
            'number.max' =>'電話番号は100文字以内で記入してください',
            'os.required' =>'OSを選択して下さい',
            'os_version.max' =>'OSバージョンは50文字以内で記入してください',
            'os_version.required' =>'OSバージョンを入力してください',
            'mobile_type.required' =>'モバイル種別を選択して下さい',
            'communication_line.required' =>'モバイル回線を選択して下さい',
            'wifi_line.required' =>'WiFi回線を選択して下さい',
            'carrier_id.required' =>'キャリアを選択して下さい',
            'sim_card.required' =>'SIM/UIMを選択して下さい',
            'charger_type.required' =>'充電器タイプを選択して下さい',
            'mail_address.max' => 'メールアドレスは100文字以内で記入してください',
            'display_size.max' =>'画面サイズは100文字以内で記入してください',
            'resolution.max' =>'解像度は100文字以内で記入してください',
            'device_img.max' => '端末画像のサイズは3000KBまでです',
            'device_img.file' => '画像のアップロードに失敗しました',
            'device_img.mimes' => 'アップロードできるのはJPEG形式の画像のみですｓ',
            'memo.max' =>'備考は1000文字以内で記入してください',
            'admin_memo.max' =>'備考は1000文字以内で記入してください'
        ];
    }

    protected function _format($inputs)
    {
        $rules = [];

        return \Format::format($inputs,$rules);
    }
}



