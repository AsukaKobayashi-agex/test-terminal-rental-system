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
        // ユーザー
        View::composer('rental.user.top.index', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.charger.charger', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.pc.pc', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.mobile.mobile', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.detail.detail_charger', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.detail.detail_pc', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device.detail.detail_mobile', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device_action.rental', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.device_action.return', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.mylist.mylist', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.mylist.mylist_register', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.profile.rent_user', 'Rental\Http\Controllers\User\UserViewComposer');
        View::composer('rental.user.profile.user_profile', 'Rental\Http\Controllers\User\UserViewComposer');

        //管理者
        View::composer('rental.admin.master.master', 'Rental\Http\Controllers\Admin\AdminViewComposer');

    }

    /**
     * Register
     */
    public function register()
    {
    }
}
