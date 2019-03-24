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

Route::get('/admin', function () {
    return view('admin');
});

Route::group(['middleware'=>['role:super-admin|city-manager','auth','forbid-banned-user'],
    ], function(){
    Route::get('/gyms', 'GymController@index')->name('gyms.index');
    Route::get('/gyms/create', 'GymController@create')->name('gyms.create');
    Route::post('/gyms', 'GymController@store')->name('gyms.store');
    Route::get('/gyms/{gym}', 'GymController@show')->name('gyms.show');
    Route::get('/gyms/{gym}/edit', 'GymController@edit')->name('gyms.edit');
    Route::put('/gyms/{gym}', 'GymController@update')->name('gyms.update');
    Route::delete('/gyms/{gym}', 'GymController@destroy')->name('gyms.destroy');
    Route::get('/gymsImage/{fileName}','GymController@getGymImage')->name('gyms.image');

    Route::get('/package', 'PackageController@index')->name('Package.index');
    Route::get('package', 'PackageController@index');
    Route::get('get-data-my-datatables', ['as'=>'get.data','uses'=>'PackageController@getData']);
    Route::get('/package/create', 'PackageController@create')->name('Package.create');
    Route::post('/package', 'PackageController@store')->name('Package.store');
    Route::get('/package/{package}', 'PackageController@show')->name('Package.show');
    Route::delete('/package/{package}', 'PackageController@destroy')->name('Package.destroy');
    Route::get('/package/{package}/edit', 'PackageController@edit')->name('Package.edit');
    Route::put('/package/{package}','PackageController@update')->name('Package.update');

    Route::get('session', 'SessionController@index');
    Route::get('get-session-my-datatables', ['as'=>'get.session','uses'=>'SessionController@getSession']);
    Route::get('/session/create', 'SessionController@create')->name('Session.create');
    Route::post('/session', 'SessionController@store')->name('Session.store');
    Route::get('/session/{session}', 'SessionController@show')->name('Session.show');
    Route::delete('/session/{session}', 'SessionController@destroy')->name('Session.destroy');
    Route::get('/session/{session}/edit', 'SessionController@edit')->name('Session.edit');
    Route::put('/session/{session}','SessionController@update')->name('Session.update');


});






Route::get('/cityManagers', 'CityManagerController@index')->name('CityManagers.index');
Route::get('/cityManagers/create', 'CityManagerController@create')->name('CityManagers.create');
Route::post('/cityManagers', 'CityManagerController@store')->name('CityManagers.store');
Route::get('/cityManagers/{mgr}', 'CityManagerController@show')->name('CityManagers.show');
Route::get('/cityManagers/{mgr}/edit', 'CityManagerController@edit')->name('CityManagers.edit');
Route::put('/cityManagers/{mgr}', 'CityManagerController@update')->name('CityManagers.update');
Route::delete('/cityManagers/{mgr}', 'CityManagerController@destroy')->name('CityManagers.destroy');



Route::get('/cities', 'CityController@index')->name('Cities.index');
Route::get('/cities/{city}', 'CityController@show')->name('Cities.show');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
