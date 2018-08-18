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

Route::resource('goods', 'Resource\GoodsController')->middleware('auth');
Route::resource('order', 'Resource\OrderController')->middleware('auth');
Route::resource('user', 'Resource\OrderController')->middleware('auth');