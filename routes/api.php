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
Route::get('list/goods/page/{page}/{num?}', function (App\Goods $goods) {
    return $goods->list($page, $num);
})
    ->where('page', '[0-9]+')
    ->where('num', '[0-9]+');
Route::get('list/order/page/{page}/{num?}')
    ->where('page', '[0-9]+')
    ->where('num', '[0-9]+');

Route::apiResource('picture','API\PictureController', ['except'  =>  [
    'index',
],]);
Route::apiResource('goods', 'API\GoodsController');
Route::apiResource('order', 'API\OrderController');