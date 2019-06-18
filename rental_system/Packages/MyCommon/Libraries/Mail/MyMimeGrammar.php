<?php

namespace MyCommon\Libraries\Mail;

// 文法チェック用クラスをメール送信仕様に合わせてカスタマイズ
class MyMimeGrammar extends \Swift_Mime_Grammar
{
    /**
     * メールアドレスのみサイト用の正規表現を返し、他は親クラスに従う
     *
     * @param string $name exactly as written in the RFC
     *
     * @return string
     */
    public function getDefinition($name)
    {
        if ($name === 'addr-spec') {
            return '([a-zA-Z0-9.\/\+%&,|}#"_~:-]+)\@([a-zA-Z0-9_])([a-zA-Z0-9._-]*)\.([a-zA-Z]+)';
        }

        return parent::getDefinition($name);
    }
}