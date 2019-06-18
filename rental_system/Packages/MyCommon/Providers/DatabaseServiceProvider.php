<?php

namespace MyCommon\Providers;

use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use MyCommon\Libraries\Database\CustomSqlServerConnection;

class DatabaseServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        Connection::resolverFor('sqlsrv', function($connection, $database, $prefix, $config) {
            return new CustomSqlServerConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('sqlsrv_slave', function($connection, $database, $prefix, $config) {
            return new CustomSqlServerConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('sqlsrv_emp_slave', function($connection, $database, $prefix, $config) {
            return new CustomSqlServerConnection($connection, $database, $prefix, $config);
        });
    }
}