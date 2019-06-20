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
    Route::get('/', 'Admin\TopController@index');

    // ...

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
