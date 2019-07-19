<?php

namespace Rental\Providers;

use Illuminate\Support\ServiceProvider;

use Rental\Services\User\Auth\UserAuthGuard;
use Rental\Services\User\Auth\UserInfoProvider;

class UserAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Auth::extend('user_auth_guard', function($app, $name, $config) {
            $userProvider = \Auth::createUserProvider($config['provider']);
            return new UserAuthGuard($userProvider);
        });

        \Auth::provider('user_provider', function($app, $config) {
            return \App::make(UserInfoProvider::class);
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
