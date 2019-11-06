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

Route::get('phpinfo', function () {
    phpinfo();
});

Route::middleware(['auth'])->group(function () {
	Route::group(['prefix' => 'admin', 'middleware' => ['role:superAdmin']], function() {
	    Route::resource('roles','RoleController');
	    Route::resource('users','UserController');
	});
	Route::get('/', 'SurveyController@index')->name('dashboard');
	Route::apiResource('/surveys','SurveyController');
	Route::get('/test', 'SurveyController@test');
	Route::get('/generateCsv', 'SurveyController@generate_csv');
	Route::get('/generateCsvUnfiltered', 'SurveyController@generate_csv_unfiltered');
});