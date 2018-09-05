<?php

use App\User;

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

//model bind
Route::get('/user/info/{user}', function (App\User $user) {
    return $user;
});

Route::get('goods/list/{uid}/{page?}/{num?}/{type?}', 'API\GoodsController@list');
Route::get('goods/new/{num?}', 'API\GoodsController@new');
Route::get('goods/hot/{num?}', 'API\GoodsController@hot');
Route::get('goods/random/{num?}', 'API\GoodsController@random');
Route::apiResource('goods', 'API\GoodsController', ['except' => [
    'store', 'update', 'destroy'
],]);

Route::get('image/id/{gid}', 'API\ImageController@index');
Route::post('image', 'API\ImageController@store');
Route::get('image/delete/{key}', 'API\ImageController@destroy');
Route::get('image/{key}', 'API\ImageController@show');

Route::get('order/{id}/status', 'API\OrderController@getStatus')
    ->where('id', '[0-9]+');