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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'forbid-banned-user'],
], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin', function () {
        return view('admin');
    });
});

Route::get('/banned', 'HomeController@banView')->name('banned');
Route::get('/notallowed', 'HomeController@notallowedView')->name('notallowed');

Route::group(['middleware' => ['role:super-admin|city-manager', 'auth', 'forbid-banned-user', 'logs-out-banned-user'],
], function () {
    Route::get('/home/{userId}/ban', 'HomeController@ban')->name('user.ban');
    Route::get('/home/{userId}/unban', 'HomeController@unban')->name('user.unban');

    Route::get('/gyms', 'GymController@index')->name('gyms.index');
    Route::get('get-gyms-data-my-datatables', 'GymController@getData')->name('gyms.data');
    Route::get('/gyms/create', 'GymController@create')->name('gyms.create');
    Route::post('/gyms', 'GymController@store')->name('gyms.store');
    Route::get('/gyms/{gym}', 'GymController@show')->name('gyms.show');
    Route::get('/gyms/{gym}/edit', 'GymController@edit')->name('gyms.edit');
    Route::put('/gyms/{gym}', 'GymController@update')->name('gyms.update');
    Route::delete('/gyms/{gym}', 'GymController@destroy')->name('gyms.destroy');

    Route::get('/GymManagers', 'GymManagerController@index')->name('GymManagers.index');
    Route::get('get-GymManagers-data-my-datatables', 'GymManagerController@getData')->name('GymManagers.data');
    Route::get('/GymManagers/create', 'GymManagerController@create')->name('GymManagers.create');
    Route::post('/GymManagers', 'GymManagerController@store')->name('GymManagers.store');
    Route::get('/GymManagers/{gymManager}', 'GymManagerController@show')->name('GymManagers.show');
    Route::get('/GymManagers/{gymManager}/edit', 'GymManagerController@edit')->name('GymManagers.edit');
    Route::put('/GymManagers/{gymManager}', 'GymManagerController@update')->name('GymManagers.update');
    Route::delete('/GymManagers/{gymManager}', 'GymManagerController@destroy')->name('GymManagers.destroy');

    Route::get('/package', 'PackageController@index')->name('Package.index');
    Route::get('package', 'PackageController@index');
    Route::get('get-data-my-datatables', ['as' => 'get.data', 'uses' => 'PackageController@getData']);
    Route::get('/package/create', 'PackageController@create')->name('Package.create');
    Route::post('/package', 'PackageController@store')->name('Package.store');
    Route::get('/package/{package}', 'PackageController@show')->name('Package.show');
    Route::delete('/package/{package}', 'PackageController@destroy')->name('Package.destroy');
    Route::get('/package/{package}/edit', 'PackageController@edit')->name('Package.edit');
    Route::put('/package/{package}', 'PackageController@update')->name('Package.update');

});
Route::group(['middleware' => ['role:super-admin', 'auth', 'forbid-banned-user', 'logs-out-banned-user'],
], function () {

    Route::get('/cityManagers', 'CityManagerController@index')->name('CityManagers.index');
    Route::get('get-cityManagers-my-datatables', ['as' => 'get.cityManagers', 'uses' => 'CityManagerController@getCityManagers']);
    Route::get('/cityManagers/create', 'CityManagerController@create')->name('CityManagers.create');
    Route::post('/cityManagers', 'CityManagerController@store')->name('CityManagers.store');
    Route::get('/cityManagers/{mgr}', 'CityManagerController@show')->name('CityManagers.show');
    Route::get('/cityManagers/{mgr}/edit', 'CityManagerController@edit')->name('CityManagers.edit');
    Route::put('/cityManagers/{mgr}', 'CityManagerController@update')->name('CityManagers.update');
    Route::delete('/cityManagers/{mgr}', 'CityManagerController@destroy')->name('CityManagers.destroy');

    Route::get('/coaches', 'CoachesController@index')->name('Coaches.index');
    Route::get('get-coaches-my-datatables', ['as' => 'get.coaches', 'uses' => 'CoachesController@getcoaches']);
    Route::get('/coaches/create', 'CoachesController@create')->name('Coaches.create');
    Route::post('/coaches', 'CoachesController@store')->name('Coaches.store');
    Route::get('/coaches/{coach}', 'CoachesController@show')->name('Coaches.show');
    Route::get('/coaches/{coach}/edit', 'CoachesController@edit')->name('Coaches.edit');
    Route::put('/coaches/{coach}', 'CoachesController@update')->name('Coaches.update');
    Route::delete('/coaches/{coach}', 'CoachesController@destroy')->name('Coaches.destroy');

    Route::get('/cities', 'CityController@index')->name('Cities.index');
    Route::get('get-cities-my-datatables', ['as'=> 'get.cities' ,'uses' =>'CityController@getcities']);
    Route::get('/cities/create', 'CityController@create')->name('Cities.create');
    Route::post('/cities', 'CityController@store')->name('Cities.store');
    Route::get('/cities/{city}', 'CityController@show')->name('Cities.show');
    Route::get('/cities/{city}/edit', 'CityController@edit')->name('Cities.edit');
    Route::put('/cities/{city}', 'CityController@update')->name('Cities.update');
    Route::delete('/cities/{city}', 'CityController@destroy')->name('Cities.destroy');

});

Route::group(['middleware' => ['role:super-admin|city-manager|gym-manager',
    'auth', 'forbid-banned-user', 'logs-out-banned-user'],
], function () {

    Route::get('session', 'SessionController@index');
    Route::get('get-session-my-datatables', ['as' => 'get.session', 'uses' => 'SessionController@getSession']);
    Route::get('/session/create', 'SessionController@create')->name('Session.create');
    Route::post('/session', 'SessionController@store')->name('Session.store');
    Route::get('/session/{session}', 'SessionController@show')->name('Session.show');
    Route::delete('/session/{session}', 'SessionController@destroy')->name('Session.destroy');
    Route::get('/session/{session}/edit', 'SessionController@edit')->name('Session.edit');
    Route::put('/session/{session}', 'SessionController@update')->name('Session.update');


    Route::get('/payment/create', 'PurchaseController@create')->name('Payment.create');
    Route::post('/payment', 'PurchaseController@store')->name('Payment.store');

    Route::get('purchase', 'PurchaseController@index');
    Route::get('get-purchase-my-datatables', ['as' => 'get.purchase', 'uses' => 'PurchaseController@getPurchase']);

    Route::get('/revenue', 'RevenueController@index')->name('Revenue.index');

    Route::get('/attendence', 'AttendenceController@index')->name('Attendence.index');
    Route::get('get-att-my-datatables', ['as' => 'get.att', 'uses' => 'AttendenceController@getAttendence']);
});
Route::post('dynamic_dependentPurchase/fetch', 'PurchaseController@fetch')->name('dynamicdependentPurchase.fetch');
Route::post('dynamic_dependentSession/fetch', 'SessionController@fetch')->name('dynamicdependentSession.fetch');
Auth::routes();
