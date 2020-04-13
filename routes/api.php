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
Route::get('/observation/download_pdf', 'ObservationController@download_pdf');
Route::get('/observation/download/logs', 'ObservationController@download_log');
Route::get('/observation/download/mlosa', 'ObservationController@download_mlosa');
Route::get('/observation_admin/download/mlosa', 'ObservationController@download_mlosa_admin');

Route::group(['middleware' => 'auth_api'], function () {

    Route::resource('user', 'UserController');
    Route::resource('uic', 'UICController');

    Route::get('/year', 'ObservationController@year');
    Route::post('/new_mlosa_plan', 'ObservationController@new_mlosa_plan');
    Route::post('/observation/{id}/upload', 'ObservationController@upload');
    Route::get('/observation/{id}/form', 'ObservationController@form');
    Route::get('/global_mlosa_plan', 'ObservationController@global_mlosa_plan');
    Route::get('/mlosa_implementation', 'ObservationController@mlosa_implementation');
    Route::get('/observation/{id}/logs', 'ObservationController@logs');
    // Route::get('/observation/download/logs', 'ObservationController@download_log');
    // Route::get('/observation/download_pdf', 'ObservationController@download_pdf');
    // Route::get('/observation/download/mlosa', 'ObservationController@download_mlosa');
    // Route::get('/observation_admin/download/mlosa', 'ObservationController@download_mlosa_admin');
    Route::get('/observation/{id}/attachments', 'ObservationController@display_attachment');
    Route::get('/maintenance_process/{id}/relation', 'MaintenanceProcessController@form');

    Route::get('/chart/safety', 'ChartController@safety');
    Route::get('/chart/threat', 'ChartController@threat');
    Route::get('/chart/breakdown', 'ChartController@breakdown');
    Route::get('/chart/pareto', 'ChartController@pareto');
    Route::get('/chart/risk_register', 'ChartController@risk_register');

    Route::get('/risk_value/calculate', 'ObservationController@calculate_risk_value');
    Route::post('/report/upload_file_editor', 'ReportController@upload_file_editor');

    Route::get('/notification', 'NotificationController@index');
    Route::get('/notification/read_all', 'NotificationController@read_all');

    // Route::post('/license', 'UserController@list_obslicense');

    Route::post('/report/test_email', 'ReportController@test_email');
    Route::get('/report/filter/filteroption', 'ReportController@filterOption');
    Route::get('/report/filter/filterreport', 'ReportController@filter');
    Route::get('/report/distribution', 'ReportController@distribution');

    Route::put('/recommendation/verify/{id}', 'RecommendationController@verify');
    Route::get('/recommendation/detail', 'RecommendationController@detail');
    Route::get('/recommendation/filter/filteroption', 'RecommendationController@filterOption');
    Route::get('/recommendation/filter/filterrecommendation', 'RecommendationController@filter');

    Route::resource('observation', 'ObservationController');
    Route::resource('activity', 'ActivityController');
    Route::resource('sub_activity', 'SubActivityController');
    Route::resource('maintenance_process', 'MaintenanceProcessController');
    Route::resource('report', 'ReportController');
    Route::resource('recommendation', 'RecommendationController');
    Route::resource('recommendation_replies', 'RecommendationRepliesController');

    Route::get('risk', 'RiskController@risk');
    Route::get('/risk/index', 'RiskController@index');
    Route::get('threat_codes', 'ThreatCodeController@all_relation');
    Route::get('probability', 'RiskController@get_probability');
    Route::post('probability', 'RiskController@add_probability');
    Route::get('severity', 'RiskController@get_severity');
    Route::post('severity', 'RiskController@add_severity');
});
