<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//==============================================================
// 管理画面
//==============================================================
Route::group(['prefix' => 'admin', 'middleware' => ['force_https', /*'admin.authed'*/]], function() {
    // TOPページ
    Route::get('/', 'Admin\RentalDeviceController@index');

    // ...

});

//==============================================================
// ユーザー画面
//==============================================================
Route::group(['middleware' => ['force_https', /*'user.authed'*/]], function () {
    // TOPページ
    Route::match(['get','post'],'/', 'User\RentalDeviceController@index');

    Route::get('/login', 'User\LoginController@login');

    Route::get('/sign-up', 'User\SignUpController@sign_up');

    Route::match(['get','post'],'/mylist', 'User\MylistController@mylist');

    Route::match(['get','post'],'/detail', 'User\DeviceDetailController@detail');

    Route::get('help/users-guide', 'User\UsersGuideController@users_guide');

    Route::match(['get','post'],'/pc', 'User\DevicePcController@pc');

    Route::match(['get','post'],'/charger', 'User\DeviceChargerController@charger');

    Route::match(['get','post'],'/smart-phone', 'User\DeviceSpController@smart_phone');

    Route::match(['get','post'],'/tablet', 'User\DeviceTabletController@tablet');

    Route::match(['get','post'],'/rent-user', 'User\RentUserController@rent_user');

    Route::match(['get','post'],'/rental', 'User\RentalController@rental');

    Route::match(['get','post'],'/return', 'User\ReturnController@return');

    Route::match(['get','post'],'/profile', 'User\ProfileController@profile');

    Route::match(['get','post'],'/mylist-register', 'User\MylistRegisterController@mylist_register');

});
