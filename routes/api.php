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

//user
Route::get('user/self', function () {
    return json_encode(
        Auth::check()
    );
});
Route::get('user/info/id/{user}', 'Api\Info@user_find')->where('id', '[0-9]+');
Route::get('user/goods/uid/{user}', 'Api\Info@get_user_goods')->where('user', '[0-9]+');
Route::post('user/update', 'Api\Operation@user_update');

//goods
Route::get('goods/info/id/{id}', 'Api\Info@goods_find')->where('id', '[0-9]+');
Route::get('goods/page/{page}/{num?}', 'Api\Info@get_goods')
    ->where('page', '[0-9]+')
    ->where('num', '[0-9]+');

Route::post('goods/submit', 'Api\Operation@goods_submit');
Route::post('goods/revoke', 'Api\Operation@goods_revoke');
Route::post('goods/update', 'Api\Operation@goods_update');
Route::post('goods/delete', 'Api\Operation@goods_delete');

//comment
Route::get('user/{user}/comment/{num?}', 'Api\Info@comment_find')
    ->where('user', '[0-9]+')
    ->where('num', '[0-9]+');
Route::post('comment/submit', 'Api\Operation@comment');
//order

//pic
//todo not tested yet
/**
 * @param \App\Enum PictureType
 * @param string
 * userProfile | goodsProfile
 */
Route::post('pic/upload/{type?}', 'PictureUploadController@picture_upload');
Route::post('pic/update', 'PictureUploadController@picture_upadate');

Route::get('test', function () {
    //return new UserResource(User::all()[0]);
});