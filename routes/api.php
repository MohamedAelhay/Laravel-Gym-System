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
Route::post('login', 'Api\ApiController@login')->name('user.login');

Route::group(['middleware' => 'auth.jwt'], function () {

    /* User End Point */
    Route::put('/update/', 'Api\ApiController@update')->name('user.update');
    Route::get('logout', 'Api\ApiController@logout')->name('user.logout');

    /* Session Route*/
    Route::get('session', 'Api\SessionController@userSessions')->name('user.sessions');
    Route::get('session/history', 'Api\SessionController@userSessionsHistory')->name('user.sessionsHistory');
    Route::post('session/{session}/attend', 'Api\SessionController@userAttendance')->name('user.attendance');

});
