<?php

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

use Illuminate\Support\Facades\Route;

Route::post('/signin', 'UserController@signin');
Route::get('/signout', 'UserController@signout');
Route::get('/check_auth', 'UserController@check_auth');

Route::group(['middleware' => 'auth_api'], function () {

    Route::resource('user', 'UserController');
    Route::resource('uic', 'UICController');

    Route::get('/year', 'ObservationController@year');
    Route::post('/new_mlosa_plan', 'ObservationController@new_mlosa_plan');
    Route::get('/global_mlosa_plan', 'ObservationController@global_mlosa_plan');
    Route::get('/mlosa_implementation', 'ObservationController@mlosa_implementation');

    Route::resource('observation', 'ObservationController');
    Route::resource('maintenance_process', 'MaintenanceProcessController');

});
