<?php

namespace App\Http\Controllers;

use App\Exports\ObservationExport;
use App\Exports\ObservationExportAdmin;
use App\Exports\ObservationLogExport;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Activity;
use App\Model\MaintenanceProcess;
use App\Model\MaintenanceProcessDetail;
use App\Model\Observation;
use App\Model\ObservationAttachments;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
use Symfony\Component\Console\Input\Input;

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

        if ($request->year != null) {
            $filter[] = [DB::raw('year(due_date)'), '=', $request->year];
        }

        if ($request->month != null) {
            $filter[] = [DB::raw('month(due_date)'), '=', $request->month];
        }

        if ($request->mp_id != null) {
            $filter[] = ['mp_id', '=', $request->mp_id];
        }

        if ($request->uic_id != null) {
            $filter[] = ['uic_id', '=', $request->uic_id];
        }

        if ($request->status != null) {
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

        if ($observation['no'] == null) {
            $model_observation = new Observation();
            $model_observation->observation_no = $this->autoNumber($uic->uic_code);

            $message = 'Observation has been created successfully';
        } else {

            $obs_team = ObservationTeam::where('observation_id', '=', $observation['id']);
            if ($obs_team != null) {
                $obs_team->delete();
            }

            $obs_detail = ObservationDetail::where('observation_id', '=', $observation['id']);
            if ($obs_detail != null) {
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
        $model_observation->describe_threat = $observation['describe_threat'];
        $model_observation->describe_crew_error = $observation['describe_crew_error'];
        $model_observation->comment = $observation['comment'];
        $model_observation->status = $observation['status'];
        $model_observation->save();

        foreach ($observation['team'] as $value) {
            Arr::set($value, 'observation_id', $model_observation->id);
            $observation_team[] = $value;
        }

        foreach ($activities as $value) {
            foreach ($value['sub_activities'] as $item) {

                $array_severity = ['A' => 10, 'B' => 5, 'C' => 3, 'D' => 2, 'E' => 1];
                $severity = $array_severity[substr($item['inputs']['risk_index'], 1)];
                $probability = substr($item['inputs']['risk_index'], 0, 1);

                if ($item['inputs']['risk_index_actual'] != null) {
                    $revised_severity = $array_severity[substr($item['inputs']['risk_index_actual'], 1)];
                    $revised_probability = substr($item['inputs']['risk_index_actual'], 0, 1);
                } else {
                    $revised_severity = 0;
                    $revised_probability = 0;
                }

                $detail = new ObservationDetail();
                $detail->observation_id = $model_observation->id;
                $detail->activity_id = $value['id'];
                $detail->sub_activity_id = $item['id'];
                $detail->safety_risk = $item['inputs']['safety_risk'];
                $detail->sub_threat_codes_id = $item['inputs']['sub_threat_codes_id'];
                $detail->risk_index = $item['inputs']['risk_index'];
                $detail->severity = $severity;
                $detail->probability = $probability;
                $detail->control_effectiveness = $item['inputs']['control_effectiveness'];
                $detail->risk_value = $item['inputs']['risk_value'];
                $detail->effectively_managed = $item['inputs']['effectively_managed'];
                $detail->error_outcome = $item['inputs']['error_outcome'];
                $detail->remark = $item['inputs']['remark'];
                $detail->risk_index_actual = $item['inputs']['risk_index_actual'];
                $detail->risk_index_proposed = $item['inputs']['risk_index_proposed'];
                $detail->revised_risk_index = $item['inputs']['revised_risk_index'];
                $detail->revised_severity = $revised_severity;
                $detail->revised_probability = $revised_probability;
                $detail->revised_control_effectiveness = $item['inputs']['revised_control_effectiveness'];
                $detail->propose_risk_value = $item['inputs']['propose_risk_value'];
                $detail->accept_or_treat = $item['inputs']['accept_or_treat'];

                $observation_detail[] = $detail->toArray();
            }
        }

        ObservationTeam::insert($observation_team);
        ObservationDetail::insert($observation_detail);

        if ($observation['status'] == "Closed" || $observation['status'] == "Verified") {
            $link_download = "api/observation/download/logs?observation_id=" . $model_observation->id;
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
            'observation_id' => $model_observation->id,
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

    public function display_attachment($id)
    {
        $data = ObservationAttachments::where('observation_id', '=', $id)->get();

        $images = [];
        foreach ($data as $key) {
            $images[] = url('') . $key->file;
        }

        return $images;
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

        if ($request->year != null) {
            $filter[] = [DB::raw('year(due_date)'), '=', $request->year];
        }

        if ($request->start_month != null) {
            $filter[] = [DB::raw('month(due_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null) {
            $filter[] = [DB::raw('month(due_date)'), '<=', $request->end_month];
        }

        if ($request->mp_id != null) {
            $filter[] = ['mp_id', '=', $request->mp_id];
        }

        if ($request->uic_id != null) {
            $filter[] = ['uic_id', '=', $request->uic_id];
        }

        if ($request->status != null) {
            $filter[] = ['status', '=', $request->status];
        }

        $model = Observation::with('uic')->Where($filter)->get();

        return new ResultCollection($model->groupBy('due_date'));
    }

    public function form(Request $request, $id)
    {
        $user = User::where('username', '=', Session::get('username'))->with('uic')->firstOrFail();
        $uic = $user->uic->uic_code;

        if ($request->observation_no !== null) {
            $observation = Observation::selectRaw('
                id,
                mp_id,
                observation_no as no,
                uic_id,
                subtitle,
                due_date,
                start_time,
                end_time,
                component_type,
                task_observed,
                location,
                status,
                describe_threat,
                describe_crew_error,
                comment
            ')->where('observation_no', '=', $request->observation_no)->first();

            $teams = ObservationTeam::selectRaw('observation_id, user_id')->where('observation_id', '=', $observation->id)->get();
            $observation['team'] = $teams;
            $id = $observation->mp_id;
        } else {
            $observation = ['no' => $this->autoNumber($uic), 'id' => -1];
        }

        $maintenance = MaintenanceProcess::find($id);
        $threat_codes = ThreatCode::all();
        $maintenance_detail = MaintenanceProcessDetail::where('mp_id', '=', $id)->pluck('activity_id');
        $activities = Activity::with(['sub_activities' => function ($query) use ($id) {
            $query->where('mp_id', '=', $id);
        }])->whereIn('id', $maintenance_detail)->get();

        foreach ($activities as $item) {
            foreach ($item->sub_activities as $value) {
                $ob_detail = ObservationDetail::where('observation_id', '=', $observation['id'])->where('activity_id', '=', $item->id)->where('sub_activity_id', '=', $value->sub_activity_id)->first();
                $input = new stdClass;
                $input->safety_risk = $ob_detail === null ? "" : $ob_detail->safety_risk;
                $input->sub_threat_codes_id = $ob_detail === null ? "" : $ob_detail->sub_threat_codes_id;
                $input->risk_index = $ob_detail === null ? "" : $ob_detail->risk_index;
                $input->control_effectiveness = $ob_detail === null ? "" : $ob_detail->control_effectiveness;
                $input->effectively_managed = $ob_detail === null ? "" : $ob_detail->effectively_managed;
                $input->error_outcome = $ob_detail === null ? "" : $ob_detail->error_outcome;
                $input->remark = $ob_detail === null ? "" : $ob_detail->remark;
                $input->risk_index_actual = $ob_detail === null ? "" : $ob_detail->risk_index_actual;
                $input->risk_index_proposed = $ob_detail === null ? "" : $ob_detail->risk_index_proposed;
                $input->revised_risk_index = $ob_detail === null ? "" : $ob_detail->revised_risk_index;
                $input->revised_severity = $ob_detail === null ? "" : $ob_detail->revised_severity;
                $input->revised_probability = $ob_detail === null ? "" : $ob_detail->revised_probability;
                $input->revised_control_effectiveness = $ob_detail === null ? "" : $ob_detail->revised_control_effectiveness;
                $input->propose_risk_value = $ob_detail === null ? "" : $ob_detail->propose_risk_value;
                $input->accept_or_treat = $ob_detail === null ? "" : $ob_detail->accept_or_treat;

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
            'observation' => $observation,
            'maintenance_process' => $maintenance,
            'threat_codes' => $threat_codes,
            'activities' => $activities
        ]);
    }

    public function upload(Request $request, $id)
    {
        $data = $request->file('file');
        $observation = Observation::find($id);

        if ($request->file('file') == null) {
            return response()->json([
                'url_files' => [],
                'message' => 'Upload gagal, file tidak ada!'
            ]);
        }

        $loc = [];
        foreach ($data as $file) {
            $filename = date('Ymd_His') . "/" .  $file->getClientOriginalName();
            $path = "/attachments" . "/" . $observation->observation_no;
            $file->move(public_path($path), $filename);

            $attachments = new ObservationAttachments();
            $attachments->observation_id = $id;
            $attachments->file = $path . "/" . $filename;
            $attachments->save();

            $loc[] = url('') . '/attachments/' . $observation->observation_no . "/" . $filename;
        }

        return response()->json([
            'url_files' => $loc,
            'message' => 'Upload berhasil!'
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

    public function download_log(Request $request)
    {
        $now = date('Ymd');
        return Excel::download(new ObservationLogExport($request), 'observation_logs_' . $now . '.xlsx');
    }

    public function download_mlosa(Request $request)
    {
        $now = date('Ymd');
        return Excel::download(new ObservationExport($request), 'mlosa_database_' . $now . '.xlsx');
    }

    public function download_mlosa_admin(Request $request)
    {
        $now = date('Ymd');
        return Excel::download(new ObservationExportAdmin($request), 'mlosa_database_' . $now . '.xlsx');
    }

    public function calculate_risk_value(Request $request)
    {
        $array_severity = ['A' => 10, 'B' => 5, 'C' => 3, 'D' => 2, 'E' => 1];
        $severity = substr($request->risk_index, 1);
        $probability = substr($request->risk_index, 0, 1);
        $risk_value = ($array_severity[$severity] * 50) + ($probability * 25) + ($request->control_effectiveness * 25);

        return response()->json([
            'risk_value' =>  $risk_value
        ]);
    }
}
