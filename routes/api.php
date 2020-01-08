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
use Illuminate\Support\Facades\DB;

Route::post('/signin', 'UserController@signin');
Route::resource('user', 'UserController');

Route::resource('observation', 'ObservationController');

Route::get('/chart_safety', function(){
    $data = DB::table('maintenance_processes')
                ->select(DB::raw('maintenance_process_details.id, maintenance_processes.name as maintenance_name, activities.name as activity_name, sub_activities.description'))
                ->join('maintenance_process_details', 'maintenance_process_details.mp_id', 'maintenance_processes.id')
                ->join('activities', 'activities.id','maintenance_process_details.activity_id')
                ->join('sub_activities', 'sub_activities.id', 'maintenance_process_details.sub_activity_id')
                ->get();
    return $data;
});

Route::get('/chart_test', function() {
    $data = DB::select('select * from vw_maintenance_process');
    return $data;
});
