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
    // TOPページ(端末一覧)
    Route::get('/', 'Admin\TopController@index');

    //端末詳細ページ
    Route::get('/information','Admin\InformationController@view');

    //Loginページ
    Route::get('/login','Admin\LoginController@login');
    Route::get('/forgot-password','Admin\LoginController@forgot_password');
    Route::get('/register','Admin\LoginController@register');

    // 端末追加
    // スマホ
    Route::get('/add_sp','Admin\Add_spController@view');
    // PC

    // 充電器
    Route::get('/add_charger', 'Admin\AddChargerController@form');
    Route::post('/add_charger/action', 'Admin\AddChargerController@action');

    //追加アクション画面

    Route::post('charger_action','Admin\Add_chargerController@confirm');

    //端末削除画面
    Route::get('/delete','Admin\DeleteController@view');

    //端末保管画面
    Route::get('/archive','Admin\ArchiveController@view');

    //端末編集画面
    Route::get('/edit','Admin\EditController@view');
    Route::get('/contract_plan','Admin\Contract_planController@view');
    Route::get('/os_prevention','Admin\OS_preventionController@view');
    Route::get('/remarks','Admin\RemarksController@view');

    //ユーザー管理画面
    Route::get('/user_admin','Admin\User_adminController@view');

    //ルール編集画面
    Route::get('/rule','Admin\RuleController@view');
});

//==============================================================
// ユーザー画面
//==============================================================
Route::group(['middleware' => ['force_https', /*'user.authed'*/]], function () {
    // TOPページ
    Route::match(['get','post'],'/', 'User\UserTopController@index');

    Route::get('/login', 'User\LoginController@login');

    Route::get('/sign-up', 'User\SignUpController@sign_up');

    Route::match(['get','post'],'/mylist', 'User\MylistController@mylist');

    Route::match(['get','post'],'/detail-mobile', 'User\DetailMobileController@detail_mobile');

    Route::match(['get','post'],'/detail-pc', 'User\DetailPcController@detail_pc');

    Route::get('help/users-guide', 'User\UsersGuideController@users_guide');

    Route::match(['get','post'],'/pc', 'User\DevicePcController@pc');

    Route::match(['get','post'],'/charger', 'User\DeviceChargerController@charger');

    Route::match(['get','post'],'/mobile', 'User\DeviceMobileController@mobile');

    Route::match(['get','post'],'/rent-user', 'User\RentUserController@rent_user');

    Route::match(['get','post'],'/rental', 'User\RentalController@rental');

    Route::match(['get','post'],'/return', 'User\ReturnController@return');

    Route::match(['get','post'],'/profile', 'User\ProfileController@profile');

    Route::match(['get','post'],'/mylist-register', 'User\MylistRegisterController@mylist_register');

});
