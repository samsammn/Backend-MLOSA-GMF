<?php

namespace App\Http\Controllers;

use App\Exports\ObservationLogExport;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Activity;
use App\Model\MaintenanceProcess;
use App\Model\MaintenanceProcessDetail;
use App\Model\Observation;
use App\Model\ObservationDetail;
use App\Model\ObservationLog;
use App\Model\ObservationTeam;
use App\Model\SubActivity;
use App\Model\ThreatCode;
use App\Model\UIC;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

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
        $observation = $request->observation;
        $activities = $request->activities;

        $uic = UIC::find($observation['uic_id']);

        if ($observation['no'] == null)
        {
            $model_observation = new Observation();
            $model_observation->observation_no = $this->autoNumber($uic->uic_code);

            $message = 'Observation has been created successfully';
        } else {

            $obs_team = ObservationTeam::where('observation_id', '=', $observation['id']);
            if ($obs_team != null)
            {
                $obs_team->delete();
            }

            $obs_detail = ObservationDetail::where('observation_id', '=', $observation['id']);
            if ($obs_detail != null)
            {
                $obs_detail->delete();
            }

            $model_observation = Observation::find($observation['id']);

            $message = 'Observation has been updated successfully';
        }

        $model_observation->mp_id = $observation['mp_id'];
        $model_observation->uic_id = $observation['uic_id'];
        $model_observation->observation_date = date('Y-m-d');
        $model_observation->due_date = $observation['due_date'];
        $model_observation->start_time = $observation['start_time'];
        $model_observation->end_time = $observation['end_time'];
        $model_observation->component_type = $observation['component_type'];
        $model_observation->task_observed = $observation['task_observed'];
        $model_observation->location = $observation['location'];
        $model_observation->status = $observation['status'];
        $model_observation->save();

        foreach ($observation['team'] as $value) {
            Arr::set($value, 'observation_id', $model_observation->id);
            $observation_team[] = $value;
        }

        foreach ($activities as $value) {
            foreach ($value['sub_activities'] as $item) {

                $detail = new ObservationDetail();
                $detail->observation_id = $model_observation->id;
                $detail->activity_id = $value['id'];
                $detail->sub_activity_id = $item['id'];
                $detail->safety_risk = $item['inputs']['safety_risk'];
                $detail->sub_threat_codes_id = $item['inputs']['sub_threat_codes_id'];
                $detail->risk_index = $item['inputs']['risk_index'];
                $detail->effectively_managed = $item['inputs']['effectively_managed'];
                $detail->error_outcome = $item['inputs']['error_outcome'];
                $detail->remark = $item['inputs']['remark'];

                $observation_detail[] = $detail->toArray();
            }
        }

        ObservationTeam::insert($observation_team);
        ObservationDetail::insert($observation_detail);

        if ($observation['status'] == "Closed" || $observation['status'] == "Verified")
        {
            $link_download = "api/observation/download/logs?observation_id=".$model_observation->id;
        } else {
            $link_download = "";
        }

        $log = new ObservationLog();
        $log->observation_id = $model_observation->id;
        $log->activity = $request->action;
        $log->date_log = date('Y-m-d');
        $log->status = $observation['status'];
        $log->link_download = $link_download;
        $log->save();

        return response()->json([
            'message' => $message
        ]);
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
        Observation::where('id', '=', $id)->delete();
        ObservationLog::where('observation_id', '=', $id)->delete();
        ObservationTeam::where('observation_id', '=', $id)->delete();
        ObservationDetail::where('observation_id', '=', $id)->delete();

        return response()->json([
            'message' => 'Observation has been deleted successfully'
        ]);
    }

    public function new_mlosa_plan(Request $request)
    {
        $uic = UIC::find($request->uic_id);

        $model = new Observation();
        $model->observation_no = $this->autoNumber($uic->uic_code);
        $model->subtitle = $request->subtitle;
        $model->due_date = $request->due_date;
        $model->observation_date = date('Y-m-d');
        $model->uic_id = $request->uic_id;
        $model->status = "Open";
        $model->save();

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
        $user = User::where('username', '=', Session::get('username'))->with('uic')->firstOrFail();
        $uic = $user->uic->uic_code;

        $observation_no = $this->autoNumber($uic);
        $maintenance = MaintenanceProcess::find($id);
        $threat_codes = ThreatCode::all();
        $maintenance_detail = MaintenanceProcessDetail::where('mp_id', '=', $id)->pluck('activity_id');
        $activities = Activity::with(['sub_activities' => function ($query) use ($id){
            $query->where('mp_id','=', $id);
        }])->whereIn('id', $maintenance_detail)->get();

        foreach ($activities as $item) {
            $input = new stdClass;
            $input->safety_risk = "";
            $input->sub_threat_codes_id = "";
            $input->risk_index = "";
            $input->control_efectivenes = "";
            $input->effectively_managed = "";
            $input->error_outcome = "";
            $input->remark = "";

            foreach ($item->sub_activities as $value) {
                $sub_activities = SubActivity::find($value->sub_activity_id);
                $value->id = $sub_activities->id;
                $value->description = $sub_activities->description;
                $value->inputs = $input;
                unset($value->mp_id);
                unset($value->activity_id);
                unset($value->sub_activity_id);
            }
        }

        return response()->json([
            'observation_no' => $observation_no,
            'maintenance_process' => $maintenance,
            'threat_codes' => $threat_codes,
            'activities' => $activities
        ]);
    }

    public function autoNumber($uic)
    {
        $year = date('Y');
        $month = date('m');

        $observation = Observation::where(DB::raw('year(observation_date)'), '=', $year)->where(DB::raw('month(observation_date)'), '=', $month)->orderBy('observation_no', 'desc')->select(DB::raw('left(observation_no, 3) as no'))->first();
        $no = $observation == null ? 1 : $observation->no + 1;

        return str_pad($no, 3, 0, STR_PAD_LEFT) . '-' . date('m-Y') . '-' . $uic;
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

    public function logs($id)
    {
        $model = ObservationLog::where('observation_id', '=', $id)->get();
        return new Result($model);
    }

    public function download(Request $request)
    {
        $now = date('Ymd');
        return Excel::download(new ObservationLogExport($request), 'observation_logs_'. $now .'.xlsx');
    }

}
