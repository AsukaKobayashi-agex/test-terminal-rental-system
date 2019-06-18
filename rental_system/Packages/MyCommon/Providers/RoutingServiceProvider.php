<?php

namespace MyCommon\Providers;

use Illuminate\Support\ServiceProvider;
use MyCommon\Libraries\Routing\CustomUrlGenerator;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $url = $this->app['url'];
        $this->app->singleton('url', function () use ($url) {
            return new CustomUrlGenerator($url);
        });
    }
}