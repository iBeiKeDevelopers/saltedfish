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

Route::get('test', 'TestController@index');

Route::get('/', 'HomeController@index');
Route::get('home', 'UserPageController@index');
Route::match(['get', 'post'], 'admin', 'AdminHomePageController@index');

Route::middleware('auth:api')->get('logout', function (Request $request) {
    Auth::logout();
    return redirect('login');
});

// error
Route::match(['get', 'post'], 'undefined', function() {
    return "mdzz好好写前端";
});