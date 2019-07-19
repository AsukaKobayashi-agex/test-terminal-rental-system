<?php

namespace Rental\Providers;

use Illuminate\Support\ServiceProvider;

use Rental\Services\Admin\Auth\AdminAuthGuard;
use Rental\Services\Admin\Auth\AdminProvider;

class AdminAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::extend('admin_auth_guard', function($app, $name, $config) {
            $userProvider = \Auth::createUserProvider($config['provider']);
            return new AdminAuthGuard($userProvider);
        });

        \Auth::provider('admin_provider', function($app, $config) {
            return \App::make(AdminProvider::class);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
