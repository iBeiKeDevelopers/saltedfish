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

Route::get('now', function() {
    return date("Y-m-d H:i:s");
});

Route::get('/', 'HomeController@index');

Route::get('home', 'UserPageController@index');

Route::match(['get', 'post'], 'admin', 'AdminHomePageController@index');

Route::post('api/home', 'HomeController@data');
Route::post('api/get_user', 'HomeController@get_user');
Route::post('api/goods_query', 'HomeController@goods_query');

Route::match(['get', 'post'], 'undefined', function() {
    return "mdzz好好写前端";
});