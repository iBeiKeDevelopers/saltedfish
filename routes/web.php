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

Route::get('/user/info', function () {
    return Auth::user();
});

Route::middleware('auth:api')->get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/', 'HomeController@index');

Route::get('goods/id/{id?}', 'Resource\GoodsController@index')
    ->where('id', '[0-9]+');
Route::get('goods/category/{cat?}', 'Resource\GoodsController@category');
Route::get('goods/list/{type}/{uid}', 'Resource\GoodsController@list')
    ->where('uid', '[0-9]+');
Route::get('goods/comments/{id}', 'Resource\GoodsController@listComments')
    ->where('id', '[0-9]+');
Route::resource('goods', 'Resource\GoodsController');

Route::get('orders/list/{type}', 'Resource\OrderController@list');
Route::resource('orders', 'Resource\OrderController');

Route::get('home', 'UserPageController@index');
Route::get('profile', 'UserPageController@profile');

Route::get('user/{uid}/goods', 'UserPageController@showGoods')
    ->where('uid', '[0-9]+');
Route::get('user/{uid}/orders', 'UserPageController@showOrders')
    ->where('uid', '[0-9]+');
Route::get('user/goods/{type}/totalsize', 'UserPageController@totalsize');
Route::get('user/goods/{page?}/{num?}/{type?}', 'UserPageController@getGoodsList')
    ->where('page', '[0-9]+')
    ->where('num', '[0-9]+');

Route::get('user/common', 'Resource\UserController@common');
Route::get('user/identity', 'Resource\UserController@identity');
Route::get('user/contact', 'Resource\UserController@contact');
Route::post('user/avatar', 'Resource\UserController@avatar');
Route::resource('user', 'Resource\UserController');

Route::post('comments/submit', 'CommentController@submit');

Route::get('chat-online/{id}', 'ChatController@index');
Route::post('chat-online/{id}', 'ChatController@sendMessageto');
Route::get('chat/history/{id}', 'ChatController@showHistory');

Route::get('test', function () {
    return view('test');
})->middleware('auth');