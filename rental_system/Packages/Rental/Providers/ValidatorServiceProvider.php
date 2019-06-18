<?php

namespace Rental\Providers;

use Illuminate\Support\ServiceProvider;
use MyCommon\Libraries\Validators\CommonValidator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 汎用的な追加バリデーション
        \Validator::resolver(function($translator, $data, $rules, $messages, $attributes) {
            return new CommonValidator($translator, $data, $rules, $messages, $attributes);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Formatクラス
        $this->app->singleton('Format', function() {
            return new \MyCommon\Libraries\Format();
        });
    }
}
