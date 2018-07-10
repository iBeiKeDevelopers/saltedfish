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
Route::get('logout', 'Auth\LoginController@logout');

Route::get('home', 'UserPageController@index');

Route::match(['get', 'post'], 'admin', 'AdminHomePageController@index');

Route::match(['get', 'post'], 'api/get_user', 'HomeController@get_user');
Route::post('api/goods_query', 'HomeController@goods_query');

Route::match(['get', 'post'], 'undefined', function() {
    return "mdzz好好写前端";
});

//编辑名片
Route::get('edit/profile', '@');
//上传商品
Route::match(['get', 'post'], 'upload/goods', '@');

Route::get('aaa', function() {
    return urlencode("http://raw-hot.com/%E7%B5%82%E3%82%8F%E3%82%8B%E4%B8%96%E7%95%8C%E3%81%AE%E3%82%A2%E3%83%AB%E3%83%90%E3%83%A0/");
} );