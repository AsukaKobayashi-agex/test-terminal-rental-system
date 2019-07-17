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
    Route::match(['get','post'],'/index_all', 'Admin\Index\IndexAllController@view');

    //一覧画面（スマホ）
    Route::match(['get','post'],'/index_sp', 'Admin\Index\IndexSpController@view');

    //一覧画面（PC）
    Route::match(['get','post'],'/index_pc', 'Admin\Index\IndexPcController@view');

    //一覧（充電器）
    Route::match(['get','post'],'/index_charger', 'Admin\Index\IndexChargerController@view');

    //端末詳細ページ
    Route::get('/information','Admin\InformationController@view');

    //Loginページ
    Route::get('/login','Admin\LoginController@login');
    Route::get('/forgot-password','Admin\LoginController@forgot_password');
    Route::get('/register','Admin\LoginController@register');

    // 追加画面（スマホ）
    Route::get('/add_sp','Admin\AddSpController@form');
    Route::post('/add_sp/action','Admin\AddSpController@action');

    // 追加画面（PC）
    Route::get('/add_pc', 'Admin\AddPcController@form');
    Route::post('/add_pc/action','Admin\AddPcController@action');

    // 追加画面（充電器）
    Route::get('/add_charger', 'Admin\AddChargerController@form');
    Route::post('/add_charger/action', 'Admin\AddChargerController@action');



    //端末編集画面
    Route::get('/edit','Admin\EditController@view');

    Route::get('/edit_charger','Admin\EditChargerController@form');

    Route::get('/contract_plan','Admin\Contract_planController@view');
    Route::get('/os_prevention','Admin\OS_preventionController@view');
    Route::get('/remarks','Admin\RemarksController@view');

});

//==============================================================
// ユーザー画面
//==============================================================
Route::group(['middleware' => ['force_https', /*'user.authed'*/]], function () {
    // TOPページ
    Route::match(['get','post'],'/', 'User\UserTopController@index');

    Route::get('/login', [
    'uses'=>'User\LoginController@login',
    'as'=>'user.login'
    ]);

    Route::post('/login', [
    'uses'=>'User\LoginController@postLogin',
    'as'=>'user.login'
    ]);

    Route::get('/sign-up', 'User\SignUpController@sign_up');

    Route::match(['get','post'],'/mylist', [
        'uses'=>'User\MylistController@mylist',
        'as'=>'user.mylist'
    ]);
    Route::post('/mylist/delete', 'User\MylistController@delete');
    Route::post('/mylist/rename', 'User\MylistController@rename');
    Route::post('/mylist/delete-mylist', 'User\MylistController@delete_mylist');


    Route::match(['get','post'],'/detail-mobile', 'User\DetailMobileController@detail_mobile');

    Route::match(['get','post'],'/detail-pc', 'User\DetailPcController@detail_pc');

    Route::match(['get','post'],'/detail-charger', 'User\DetailChargerController@detail_charger');

    Route::get('help/users-guide', 'User\UsersGuideController@users_guide');

    Route::match(['get','post'],'/pc', 'User\DevicePcController@pc');

    Route::match(['get','post'],'/charger', 'User\DeviceChargerController@charger');

    Route::match(['get','post'],'/mobile', 'User\DeviceMobileController@mobile');

    Route::match(['get','post'],'/rent-user', 'User\RentUserController@rent_user');

    Route::match(['get','post'],'/rental', 'User\RentalController@view');
    Route::post('/rental/rental', 'User\RentalController@rental');

    Route::match(['get','post'],'/return', 'User\ReturnController@view');
    Route::post('/return/return', 'User\ReturnController@return');

    Route::match(['get','post'],'/profile', 'User\ProfileController@profile');

    Route::match(['get','post'],'/mylist-register', 'User\MylistRegisterController@mylist_register');
    Route::post('/mylist-register/register', 'User\MylistRegisterController@register');

});
