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
Route::get('user/info/{user}', function (App\User $user) {
    return $user;
});

Route::apiResource('picture','API\PictureController', ['except'  =>  [
    'index',
],]);

Route::get('goods/list', 'API\GoodsController@list');
Route::apiResource('goods', 'API\GoodsController', ['except' => [
    'store',
],]);

Route::apiResource('order', 'API\OrderController', ['except' => [
    'index', 'store',
]]);
