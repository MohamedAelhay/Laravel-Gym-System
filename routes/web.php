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

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>['auth','forbid-banned-user'],
    ], function(){
    Route::get('/admin', function () {
        return view('admin');
    });
    Route::get('/gyms', 'GymController@index')->name('gyms.index');
    Route::get('/gyms/create', 'GymController@create')->name('gyms.create');
    Route::post('/gyms', 'GymController@store')->name('gyms.store');
    Route::get('/gyms/{gym}', 'GymController@show')->name('gyms.show');
    Route::get('/gyms/{gym}/edit', 'GymController@edit')->name('gyms.edit');
    Route::put('/gyms/{gym}', 'GymController@update')->name('gyms.update');
    Route::delete('/gyms/{gym}', 'GymController@destroy')->name('gyms.destroy');

});
Auth::routes();


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
