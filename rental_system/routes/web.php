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
    Route::get('/', 'User\TopController@index');

    Route::get('/login', 'User\TopController@login');

    Route::get('/sign-up', 'User\TopController@sign_up');

    Route::get('/mylist', 'User\TopController@mylist');

    Route::get('/detail', 'User\TopController@detail');

    Route::get('help/users-guide', 'User\TopController@users_guide');

    Route::get('/pc', 'User\TopController@pc');

    Route::get('/charger', 'User\TopController@charger');

    Route::get('/sp', 'User\TopController@sp');

    Route::get('/tablet', 'User\TopController@tablet');

    Route::get('/rent-user', 'User\TopController@rent_user');

    Route::get('/rental', 'User\TopController@rental');

    Route::get('/return', 'User\TopController@return');

    Route::get('/profile', 'User\TopController@profile');

    Route::get('/mylist-register', 'User\TopController@mylist_register');
    Route::post('/mylist-register', 'User\TopController@mylist_register');

});
