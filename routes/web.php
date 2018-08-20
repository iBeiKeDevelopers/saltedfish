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
Auth::routes();

Route::get('user/info', function () {
    return Auth::user();
});

Route::middleware('auth:api')->get('logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('/', 'HomeController@index');
Route::get('home', 'UserPageController@index');

Route::get('goods/list/{type}/{uid}', 'Resource\GoodsController@list');
Route::resource('goods', 'Resource\GoodsController');

Route::get('orders/list/{type}/{num?}', 'Resource\OrderController@list');
Route::resource('orders', 'Resource\OrderController')->middleware('auth');

Route::get('profile', 'UserPageController@profile');
Route::resource('users', 'Resource\UserController')->middleware('admin');