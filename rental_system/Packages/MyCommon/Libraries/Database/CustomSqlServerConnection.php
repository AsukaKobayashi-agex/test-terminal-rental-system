<?php

namespace MyCommon\Libraries\Database;

use PDO;
use \Illuminate\Database\SqlServerConnection;

class CustomSqlServerConnection extends SqlServerConnection
{
    public function bindValues($statement, $bindings)
    {
        foreach ($bindings as $key => $value) {
            $dataType = PDO::PARAM_STR;
            if (is_int($value) || preg_match('/^[1-9][0-9]*$/', $value)) {
                $dataType = PDO::PARAM_INT;
            }

            $statement->bindValue(
                is_string($key) ? $key : $key + 1, $value,
                $dataType
            );
        }
    }
}