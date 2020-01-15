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
use App\Http\Resources\ResultCollection;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::post('/signin', 'UserController@signin');
Route::get('/signout', 'UserController@signout');
Route::get('/check_auth', 'UserController@check_auth');

Route::group(['middleware' => 'auth_api'], function () {

    Route::resource('user', 'UserController');
    Route::resource('uic', 'UICController');

    Route::post('/new_mlosa_plan', 'ObservationController@new_mlosa_plan');
    Route::resource('observation', 'ObservationController');
    Route::resource('maintenance_process', 'MaintenanceProcessController');

});
