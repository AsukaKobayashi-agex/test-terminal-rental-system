<?php namespace Rental\Providers;

use Illuminate\Support\Facades\View; // Illuminate\Contracts\View\Factory
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * return void
     */
    public function boot()
    {
        // ここにcomposerを使用する処理を記述します
        // クラスベースのcomposer
        View::composer('rental.user.top.index', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.charger.charger', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.pc.pc', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.mobile.mobile', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.detail.detail_charger', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.detail.detail_pc', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device.detail.detail_mobile', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device_action.rental', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.device_action.return', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.mylist.mylist', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.mylist.mylist_register', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.profile.rent_user', 'Rental\Http\Controllers\User\ViewComposer');
        View::composer('rental.user.profile.user_profile', 'Rental\Http\Controllers\User\ViewComposer');

    }

    /**
     * Register
     */
    public function register()
    {
    }
}
