<?php

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes(['verify' => true]);

Route::post('register', 'Api\ApiController@register');
Route::post('login', 'Api\ApiController@login')
    ->name('user.login');

Route::group(['middleware' => 'auth.jwt'], function () {

//    Route::get('/user/{user}/edit', 'Api\ApiController@edit')
//        ->name('user.edit');

    Route::put('/update/', 'Api\ApiController@update')
        ->name('user.update');

    Route::get('logout', 'Api\ApiController@logout')
        ->name('user.logout');

});
