<?php

namespace MyCommon\Libraries\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

abstract class MailBase extends Mailable
{
    use Queueable, SerializesModels;

    // メール本文に含めるデータ (blade内で参照)
    public $body_data;

    // メール種別
    protected $_mail_type;

    // メール送信パラメータ
    protected $_parameter;
    protected $_parameter_key = [
        'from_address',         // FROMアドレス
        'from_name',            // 差出人名
        'return',               // リターンパス
        'to',                   // 宛先
        'cc',                   // カーボンコピー
        'bcc',                  // ブラインドカーボンコピー
        'subject'               // 件名
    ];

    // メール本文を記載したbladeのパスを取得
    abstract protected function _getBladePathWithBody($mail_type);

    public function __construct($mail_type='', $param = [], $body_data = [])
    {
        //RFC違反のメールも送信できるよう、文法(正規表現)定義クラスを差し替え
        \Swift_DependencyContainer::getInstance()
            ->register('email.validator')
            ->asSharedInstanceOf(MyEmailValidator::class);

        $this->setMail($mail_type, $param, $body_data);
    }

    public function setMail($mail_type, $param = [], $body_data = [])
    {
        $this->setMailType($mail_type);
        $this->setParam($param);
        $this->setBodyData($body_data);
    }

    public function setParam($param)
    {
        $this->_parameter = [];

        foreach($this->_parameter_key as $key) {
            if (array_key_exists($key, $param)) {
                $this->_parameter[$key] = $param[$key];
            }
        }
    }

    public function setBodyData($data)
    {
        $this->body_data = $data;
    }

    public function setMailType($type)
    {
        $this->_mail_type = $type;
    }

    // ------------------------------------------------------------------------

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 送信元メールアドレス未設定の場合はデフォルト値を用いる
        $from_address = (!empty(array_get($this->_parameter, 'from_address'))) ?
            $this->_parameter['from_address'] : config('my.mail.MAIL_FROM_DEFAULT_ADDRESS');

        //送信元
        if (!empty(array_get($this->_parameter, 'from_name'))) {
            $this->from($from_address, $this->_parameter['from_name']);
        } else {
            $this->from($from_address);
        }

        //リターンパス
        if (!empty(array_get($this->_parameter, 'return'))) {
            $this->withSwiftMessage(function (\Swift_Message $message) {
                $message
                    ->setReturnPath($this->_parameter['return']);
            });
        }else{
            // 送信元メールアドレス未設定の場合はデフォルト値を用いる
            $this->withSwiftMessage(function (\Swift_Message $message) {
                $from_address = (!empty(array_get($this->_parameter, 'from_address'))) ?
                    $this->_parameter['from_address'] : config('my.mail.MAIL_FROM_DEFAULT_ADDRESS');
                $message
                    ->setReturnPath($from_address);
            });
        }

        //宛先
        $to = array_get($this->_parameter, 'to');
        if ($this->_validateTo($to) && !$this->hasTo($to)) {
            $this->to($to);
        }

        //カーボンコピー
        if (!empty(array_get($this->_parameter, 'cc'))) {
            $this->cc($this->_parameter['cc']);
        }

        //ブラインドカーボンコピー
        if (!empty(array_get($this->_parameter, 'bcc'))) {
            $this->bcc($this->_parameter['bcc']);
        }

        //件名
        if (!empty(array_get($this->_parameter, 'subject'))) {
            $this->subject($this->_parameter['subject']);
        }

        return $this->text($this->_getBladePathWithBody($this->_mail_type));
    }

    protected function _validateTo($to)
    {
        if (empty($to)) {
            return false;
        }
        if (in_array(config('app.env'), ['local', 'development', 'test'])) {
            $domain = array_get(explode('@', $to), 1, '');
            $allowed_domain_list = config('my.mail.ALLOWED_DOMAIN_LIST');
            if (!in_array($domain, $allowed_domain_list)) {
                return false;
            }
        }
        return true;
    }

    public function send(MailerContract $mailer)
    {
        if (empty(config('my.mail.MAIL_SEND_FLAG'))) {
            return;
        }
        return parent::send($mailer);
    }
}