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
    Route::get('/observation/{id}/form', 'ObservationController@form');
    Route::get('/global_mlosa_plan', 'ObservationController@global_mlosa_plan');
    Route::get('/mlosa_implementation', 'ObservationController@mlosa_implementation');
    Route::get('/observation/{id}/logs', 'ObservationController@logs');
    Route::get('/observation/download/logs', 'ObservationController@download');
    Route::get('/maintenance_process/{id}/relation', 'MaintenanceProcessController@form');

    Route::get('/chart/safety', 'ChartController@safety');
    Route::get('/chart/threat', 'ChartController@threat');
    Route::get('/chart/equipment', 'ChartController@equipment');
    Route::get('/chart/pareto', 'ChartController@pareto');

    Route::resource('observation', 'ObservationController');
    Route::resource('activity', 'ActivityController');
    Route::resource('sub_activity', 'SubActivityController');
    Route::resource('maintenance_process', 'MaintenanceProcessController');
    Route::resource('report', 'ReportController');

    Route::get('risk', 'RiskController@risk');
    Route::get('threat_codes', 'ThreatCodeController@all_relation');
    Route::get('probability', 'RiskController@get_probability');
    Route::post('probability', 'RiskController@add_probability');
    Route::get('severity', 'RiskController@get_severity');
    Route::post('severity', 'RiskController@add_severity');

    Route::get('filteroption','ReportController@filterOption');
    Route::get('filter','ReportController@filter');

});
