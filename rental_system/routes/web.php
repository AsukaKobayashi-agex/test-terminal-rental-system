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
Route::group(['prefix' => 'admin', 'middleware' => ['force_https']], function() {

    Route::group(['middleware' => ['admin.unauthed']], function () {
        Route::get('login', 'Admin\Login\LoginController@form');
        Route::post('login', 'Admin\Login\LoginController@login');
    });

    Route::group(['middleware' => ['admin.authed']], function () {

        //一覧画面

        // TOPページ(端末一覧)
        Route::match(['get','post'],'/index_all', 'Admin\Index\IndexAllController@view');

        //一覧画面（スマホ）
        Route::match(['get','post'],'/index_sp', 'Admin\Index\IndexSpController@view');

        //一覧画面（PC）
        Route::match(['get','post'],'/index_pc', 'Admin\Index\IndexPcController@view');

        //一覧画面（充電器）
        Route::match(['get','post'],'/index_charger', 'Admin\Index\IndexChargerController@view');

        //-----------------------------------------------------------------------------------------------

        //追加画面

        // 追加画面（スマホ）
        Route::get('/add_sp','Admin\AddSpController@form');
        Route::post('/add_sp/action','Admin\AddSpController@action');

        // 追加画面（PC）
        Route::get('/add_pc', 'Admin\AddPcController@form');
        Route::post('/add_pc/action','Admin\AddPcController@action');

        // 追加画面（充電器）
        Route::get('/add_charger', 'Admin\AddChargerController@form');
        Route::post('/add_charger/action', 'Admin\AddChargerController@action');

        //-----------------------------------------------------------------------------------------------
        Route::get('/logout', 'Admin\Login\LogoutController@logout');

        //編集画面

        //編集画面（SP）
        Route::get('/edit_sp','Admin\Edit\EditSpController@view');
        Route::post('/edit_sp/action','Admin\Edit\EditSpController@action');

        //編集画面（PC）
        Route::get('/edit_pc','Admin\Edit\EditPcController@view');
        Route::post('/edit_pc/action','Admin\Edit\EditPcController@action');

        //編集画面（充電器）
        Route::get('/edit_charger','Admin\Edit\EditChargerController@view');
        Route::post('/edit_charger/action','Admin\Edit\EditChargerController@action');

        //-----------------------------------------------------------------------------------------------

        //詳細画面

        //詳細画面（SP）
        Route::get('/info_sp','Admin\Info\InfoSpController@view');

        //詳細画面（PC）
        Route::get('/info_pc','Admin\Info\InfoPcController@view');

        //詳細画面（充電器）
        Route::get('/info_charger','Admin\Info\InfoChargerController@view');

        //アプリ・ソフトウェア追加画面
        Route::get('/master','Admin\Master\MasterController@view');
        Route::post('/master/add_app','Admin\Master\MasterController@add_app');
        Route::post('/master/delete_app','Admin\Master\MasterController@delete_app');
        Route::post('/master/rename_app','Admin\Master\MasterController@rename_app');
        Route::post('/master/add_software','Admin\Master\MasterController@add_software');
        Route::post('/master/delete_software','Admin\Master\MasterController@delete_software');
        Route::post('/master/rename_software','Admin\Master\MasterController@rename_software');
        Route::post('/master/add_carrier','Admin\Master\MasterController@add_carrier');
        Route::post('/master/delete_carrier','Admin\Master\MasterController@delete_carrier');
        Route::post('/master/rename_carrier','Admin\Master\MasterController@rename_carrier');

    });
});

//==============================================================
// ユーザー画面
//==============================================================
Route::group(['middleware' => ['force_https']], function () {




    // ログアウトならアクセス出来る画面
    Route::group(['middleware' => ['user.unauthed']], function () {
        Route::get('/login', [
            'uses' => 'User\LoginController@login',
            'as' => 'user.login'
        ]);

        Route::post('/login', [
            'uses' => 'User\LoginController@postLogin',
            'as' => 'user.login'
        ]);

        Route::get('/sign-up', 'User\SignUpController@view');
        Route::post('/sign-up/sign-up', 'User\SignUpController@sign_up');
        Route::match(['get','post'],'/sign-up/sign-up-confirm', 'User\SignUpController@sign_up_confirm');
    });

    // ログインならアクセス出来る画面
    Route::group(['middleware' => ['user.authed']], function () {

        //マイリスト画面
        Route::match(['get','post'],'/mylist', [
            'uses'=>'User\MylistController@mylist',
            'as'=>'user.mylist'
        ]);
        Route::post('/mylist/delete', 'User\MylistController@delete');
        Route::post('/mylist/rename', 'User\MylistController@rename');
        Route::post('/mylist/delete-mylist', 'User\MylistController@delete_mylist');

        //貸出画面
        Route::match(['get','post'],'/rental', 'User\RentalController@view');
        Route::post('/rental/rental', 'User\RentalController@rental');

        //返却画面
        Route::match(['get','post'],'/return', 'User\ReturnController@view');
        Route::post('/return/return', 'User\ReturnController@return');

        //プロフィール編集
        Route::match(['get','post'],'/profile', 'User\UserProfileController@user_profile');
        Route::post('/profile/change-profile', 'User\UserProfileController@change_profile');

        //マイリスト登録
        Route::match(['get','post'],'/mylist-register', 'User\MylistRegisterController@mylist_register');
        Route::post('/mylist-register/register', 'User\MylistRegisterController@register');

        //ログアウト
        Route::get('/logout', 'User\LogoutController@logout');

    });

    // ログイン・ログアウトに関わらずアクセスできる画面
    // TOPページ
    Route::match(['get','post'],'/', 'User\UserTopController@index');

    //PC一覧
    Route::match(['get','post'],'/pc', 'User\DevicePcController@pc');

    //充電器一覧
    Route::match(['get','post'],'/charger', 'User\DeviceChargerController@charger');

    //モバイル一覧
    Route::match(['get','post'],'/mobile', 'User\DeviceMobileController@mobile');

    //モバイル詳細
    Route::match(['get','post'],'/detail-mobile', 'User\DetailMobileController@detail_mobile');

    //PC詳細
    Route::match(['get','post'],'/detail-pc', 'User\DetailPcController@detail_pc');

    //充電器詳細
    Route::match(['get','post'],'/detail-charger', 'User\DetailChargerController@detail_charger');

    //利用マニュアル
    //Route::get('help/users-guide', 'User\UsersGuideController@users_guide');

    //借りているユーザー詳細
    Route::match(['get','post'],'/rent-user', 'User\RentUserController@rent_user');

});


