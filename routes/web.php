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

use Illuminate\Support\Facades\DB;
use App\Model\Activity;
use App\Model\MaintenanceProcess;
use App\Model\MaintenanceProcessDetail;
use App\Model\Observation;
use App\Model\ObservationDetail;
use App\Model\SubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {

    $data['activity'] = Activity::all();
    $data['subactivity'] = SubActivity::all();
    $data['maintenance'] = MaintenanceProcess::all();

    return view('test.index', $data);
});

Route::get('/detail', function (Request $request) {

    $data['mp'] = $request->mp;
    $data['safety'] = DB::select('select * from safety_risks');
    $data['sub_threat'] = DB::select('select * from sub_threat_codes');
    $data['maintenance'] = DB::select('select * from maintenance_processes');
    $data['maintenance_detail'] = DB::select('select * from vw_maintenance_process where maintenance_name = "'.$request->mp.'"');

    return view('test.detail', $data);
});

Route::post('/detail', function (Request $request){
    $id_mp_detail = $request->id_mp_detail;
    $safety_risk = $request->safety_risk;
    $sub_threat = $request->sub_threat;
    $effectively_managed = $request->effectively_managed;
    $error_outcome = $request->error_outcome;

    $mprocess= MaintenanceProcess::where('name','=', $request->mp)->firstOrFail();

    $query_ob = [
        'observation_no' => $request->observation_no,
        'observation_date' => $request->observation_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'due_date' => date("Y-m-d"),
        'mp_id' => $mprocess->id,
        'component_type' => $request->component_type,
        'task_observed' => $request->task_observed,
        'location' => $request->location,
    ];

    $ob = Observation::create($query_ob);

    for ($i=0; $i<count($request->id_mp_detail); $i++){

        $query_ob_detail[] = [
            'observation_id' => $ob->id,
            'mp_detail_id' => $id_mp_detail[$i],
            'safety_risk_id' => $safety_risk[$i],
            'sub_threat_code_id' => $sub_threat[$i],
            'effectively_managed' => $effectively_managed[$i],
            'error_outcome' => $error_outcome[$i],
        ];
    }

    $ob_detail = ObservationDetail::insert($query_ob_detail);

    return response()->json(['main' => $ob, 'detail' => $ob_detail ]);
});

Route::post('/', function (Request $request) {
    $mp_detail = new MaintenanceProcessDetail();

    $mp_detail->mp_id = $request->mp_id;
    $mp_detail->activity_id = $request->activity_id;
    $mp_detail->sub_activity_id = $request->sub_activity_id;
    $mp_detail->save();

    // Session::set('mp_id', $request->mp_id);
    // Session::set('activity_id', $request->activity_id);
    // Session::set('sub_activity_id', $request->sub_activity_id);

    return redirect()->back();
});
