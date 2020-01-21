<?php

namespace App\Http\Controllers;

use App\Http\Resources\ObservationCollection;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Activity;
use App\Model\MaintenanceProcess;
use App\Model\MaintenanceProcessDetail;
use App\Model\Observation;
use App\Model\ObservationTeam;
use App\Model\ThreatCode;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter = [];

        if ($request->year != null)
        {
            $filter[] = [DB::raw('year(due_date)'), '=', $request->year];
        }

        if ($request->month != null)
        {
            $filter[] = [DB::raw('month(due_date)'), '=', $request->month];
        }

        if ($request->mp_id != null)
        {
            $filter[] = ['mp_id', '=', $request->mp_id];
        }

        if ($request->uic_id != null)
        {
            $filter[] = ['uic_id', '=', $request->uic_id];
        }

        if ($request->status != null)
        {
            $filter[] = ['status', '=', $request->status];
        }

        $model = Observation::with(['uic', 'maintenance', 'users' => function ($query) {
                    $query->select('users.id', 'username', 'fullname', 'position', 'role', 'obslicense');
                }])->where($filter)->search($request->search)->get();

        return new Result($model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Observation::with(['uic', 'maintenance', 'users' => function ($query) {
                    $query->select('users.id', 'username', 'fullname', 'position', 'role', 'obslicense');
                }])->find($id);

        return new Result($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // insert to observation
        $model = Observation::find($id);
        $model->observation_no = Str::random();
        $model->observation_date = $request->observation_date;
        $model->start_time = $request->start_time;
        $model->end_time = $request->end_time;
        $model->mp_id = $request->mp_id;
        $model->component_type = $request->component_type;
        $model->task_observed = $request->task_observed;
        $model->location = $request->location;
        $model->status = "On Progress";
        $model->save();

        // insert to observation team with relation
        ObservationTeam::insert($request->observation_team);

        return new Result($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function new_mlosa_plan(Request $request)
    {
        $model = Observation::create($request->all());
        return new Result($model);
    }

    public function global_mlosa_plan(Request $request)
    {
        $filter = [];

        if ($request->year != null)
        {
            $filter[] = [DB::raw('year(due_date)'), '=', $request->year];
        }

        if ($request->start_month != null)
        {
            $filter[] = [DB::raw('month(due_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null)
        {
            $filter[] = [DB::raw('month(due_date)'), '<=', $request->end_month];
        }

        if ($request->mp_id != null)
        {
            $filter[] = ['mp_id', '=', $request->mp_id];
        }

        if ($request->uic_id != null)
        {
            $filter[] = ['uic_id', '=', $request->uic_id];
        }

        if ($request->status != null)
        {
            $filter[] = ['status', '=', $request->status];
        }

        $model = Observation::with('uic')->Where($filter)->get();

        return new ResultCollection($model->groupBy('due_date'));
    }

    public function form($id)
    {
        $observation_no = $this->autoNumber();
        $maintenance = MaintenanceProcess::find($id);
        $threat_codes = ThreatCode::all();
        $maintenance_detail = MaintenanceProcessDetail::where('mp_id', '=', $id)->pluck('activity_id');//->select('activity_id')->get();
        $activities = Activity::with(['sub_activities'])->whereIn('id', $maintenance_detail)->get();

        return response()->json([
            'observation_no' => $observation_no,
            'maintenance_process' => $maintenance,
            'threat_codes' => $threat_codes,
            'activities' => $activities
        ]);
    }

    public function autoNumber()
    {
        $now = date('Y-m-d');
        $count = Observation::where('observation_date', '=', $now)->count();
        $user = User::where('username', '=', Session::get('username'))->with('uic')->firstOrFail();
        $uic = $user->uic->uic_code;

        return str_pad($count + 1, 3, 0, STR_PAD_LEFT) . '-' . date('m-Y') . '-' . $uic;
    }

    public function mlosa_implementation()
    {
        $model = Observation::select(DB::raw('count(*) as count'), 'status')->groupBy('status')->get();
        return new ResultCollection($model);
    }

    public function year()
    {
        $model = Observation::select(DB::raw('year(due_date) as year'))->distinct('due_date')->pluck('year');
        return $model;
    }

}
