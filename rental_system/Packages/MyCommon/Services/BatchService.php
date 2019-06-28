<?php

namespace MyCommon\Services;

use Engage\Libraries\Mail\BatchMail;
use MyCommon\Models\BatLogData;

class BatchService
{
    protected $_logData;

    protected $_tickStart;

    // ------------------------------------------------------------------------

    public function __construct(BatLogData $logData)
    {
        $this->_logData = $logData;

        // 最大実行時間を無制限に設定
        if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0) {
            @set_time_limit(0);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * tickStart
     *
     * 処理開始
     *
     * @return void
     */
    public function tickStart()
    {
        // 処理時間の測定
        $this->_tickStart = microtime(true);
    }

    // ------------------------------------------------------------------------

    /**
     * tickEnd
     *
     * 処理終了
     *
     * @return string 処理時間
     */
    public function tickEnd()
    {
        $tickEnd = microtime(true);
        return number_format(($tickEnd - $this->_tickStart) * 1000);
    }

    // ------------------------------------------------------------------------

    /**
     * prepare
     *
     * 開始前処理
     *
     * @param int $taskID タスクI
     * @param string $dateID 日付ID YYYYMMDD
     * @param int $retry 再実行
     */
    public function prepare($taskID=0, $dateID, $retry = 0)
    {
        // 2重実行ではないか確認
        if ($retry != 1) {
            $batLogData = $this->_logData->getBatLogData($taskID, $dateID);
            if (!empty($batLogData)) {
                echo 'すでに実行されています。';
                exit;
            }
        } else {
            // ログデータの追加/更新
            $this->_logData->updateBatLogData($taskID, $dateID);
        }

        // 処理時間の測定
        $this->tickStart();
    }

    // ------------------------------------------------------------------------

    /**
     * postProcessing
     *
     * 後処理
     *
     * @param int       $taskID     タスクID
     * @param string    $subject    メール件名
     * @param string    $message    メール本文
     * @param string    $dateID     日付
     * @param boolean   $mailFlg    メール送信フラグ
     * @return void
     */
    public function postProcessing($taskID=0, $subject='', $message='', $dateID='', $mailFlg=TRUE)
    {
        // ログデータの追加/更新
        if ($dateID != '') {
            $this->_logData->updateBatLogData($taskID, $dateID);
        }

        // メール送信処理
        if ($mailFlg) {
            $mail_type = BatchMail::DEFAULT_MAIL;
            $parameter = [
                'subject' => $subject,
                'to' => config('my.mail.MAIL_TO_BAT'),
                'from_address' => config('my.mail.MAIL_FROM_BAT'),
            ];

            $body_data = [
                'message' => $message,
                'execution_date_time' => date('Y/m/d H:i:s'),
                'execution_time' => $this->tickEnd(),
                'server_name' => gethostname(),
            ];
            $mailer = new BatchMail($mail_type, $parameter, $body_data);
            \Mail::send($mailer);
        }

        // 処理の完了を画面に表示する
        echo "バッチ処理終了：{$subject} TaskID：{$taskID}".PHP_EOL;
    }

    // -----------------------------------------------------------------------
}
