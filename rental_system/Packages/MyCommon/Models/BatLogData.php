<?php

namespace MyCommon\Models;

use Illuminate\Database\Eloquent\Model;

class BatLogData extends Model
{
    // テーブル名
    const TABLE = 'batch_log';

    // プライマリーキー設定
    protected $primaryKey = ['task_id', 'date_id'];

    // increment無効化
    public $incrementing = false;

    // タイムスタンプを更新するかの指示
//    public $timestamps = true;

    // タイムスタンプを保存するカラム名
    const CREATED_AT = 'registration_datetime';
    const UPDATED_AT = 'update_datetime';

    // ------------------------------------------------------------------------

    /**
     * updateBatLogData
     *
     * バッチログデータの更新
     *
     * @param string $taskID
     * @param string $dateID
     */
    public function updateBatLogData($taskID, $dateID)
    {
        $nowDate = nowDateTime();

        $attributes = [];
        $attributes['task_id'] = $taskID;
        $attributes['date_id'] = $dateID;

        $values = [];
        $values['update_datetime'] = $nowDate;

        $query = \DB::table(self::TABLE)->where($attributes);
        if (!$query->exists()) {
            $values['registration_datetime'] = $nowDate;
            return \DB::table(self::TABLE)->insert(array_merge($attributes, $values));
        } else {
            return $query->update($values);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * getBatLogData
     *
     * バッチログデータの取得
     *
     * @param string $taskID タスクID
     * @param string $dateID
     * @return array バッチログデータ
     */
    public function getBatLogData($taskID, $dateID)
    {
        $param = [
            'task_id' => $taskID,
            'date_id' => $dateID,
        ];

        $sql = <<< End_of_sql
SELECT
    task_id
    ,date_id
    ,registration_datetime
    ,update_datetime
FROM batch_log
WHERE
    task_id = :task_id
    AND
    date_id = :date_id

End_of_sql;

        return \DB::selectOne($sql, $param);
    }

    // ------------------------------------------------------------------------

    /**
     * getBatLogDataForASP
     *
     * バッチログデータの取得
     *
     * @param string $taskID タスクID
     * @param string $dateID
     * @return array バッチログデータ
     */
    public function getBatLogDataForASP($taskID, $dateID='')
    {
        $param = [
            'nowDate' => nowDateTime(),
            'task_id' => $taskID,
            'date_id' => $dateID,
        ];

        $sql = <<< End_of_sql
SELECT
    task_id
    ,date_id
    ,registration_datetime
    ,update_datetime
    ,TIMESTAMPDIFF(SECOND, update_datetime, :nowDate) AS diff_seconds
FROM batch_log
WHERE
    task_id = :task_id
    AND
    date_id = :date_id

End_of_sql;

        return \DB::selectOne($sql, $param);
    }

    // ------------------------------------------------------------------------
}
