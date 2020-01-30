<?php

namespace App\Http\Controllers;

use App\Model\MaintenanceProcess;
use App\Model\SafetyRisk;
use App\Model\ThreatCode;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use stdClass;

class ChartController extends Controller
{
    public function safety(Request $request)
    {
        $filter = [];
        // $group = [DB::raw('mp.id'), DB::raw('mp.name'), DB::raw('od.safety_risk')];
        $group = [DB::raw('mp.id'), DB::raw('mp.name'), DB::raw('od.safety_risk')];

        if ($request->year != null){
            $group[] = DB::raw('year(o.observation_date)');
            $filter[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
        }

        if ($request->start_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
        }

        if ($request->maintenance_process != null){
            $filter[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
        }

        if ($request->safety_risk != null){
            $filter[] = [DB::raw('od.safety_risk'), '=', $request->safety_risk];
        }

        $model = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        mp.id,
                        mp.name,
                        od.safety_risk,
                        count(*) as total
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->groupBy($group)
                    ->where($filter)
                    ->orderBy('safety_risk')
                    ->get();

        $mp_id = $model->pluck('id');
        $safety = SafetyRisk::orderBy('code')->get();
        $mp = MaintenanceProcess::whereIn('id', $mp_id)->get();

        $temp = [];
        foreach ($model->groupBy('name') as $key => $val) {
           foreach ($val as $value) {
                $temp[$key][$value->safety_risk] = $value->total;
           }
        }

        $result = [];
        foreach ($mp as $key) {
            foreach ($safety as $keys) {
                if (isset($temp[$key->name][$keys->code]) && $temp[$key->name][$keys->code] != 0)
                {
                    $result[$key->name][$keys->code] = $temp[$key->name][$keys->code];
                } else {
                    $result[$key->name][$keys->code] = 0;
                }
            }
        }

        return $result;
    }

    public function threat(Request $request)
    {
        $filter = [];
        $group = [DB::raw('mp.id'), DB::raw('mp.name'), DB::raw('tc.description')];

        if ($request->year != null){
            $group[] = DB::raw('year(o.observation_date)');
            $filter[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
        }

        if ($request->start_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
        }

        if ($request->maintenance_process != null){
            $filter[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
        }

        if ($request->threat != null){
            $filter[] = [DB::raw('tc.description'), '=', $request->threat];
        }

        $model = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        mp.id,
                        mp.name as maintenance,
                        tc.description as threat,
                        count(*) as total
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->groupBy($group)
                    ->orderBy('maintenance')
                    ->where($filter)
                    ->get();


        $main_name = $model->pluck('maintenance');
        $threat_dec = $model->pluck('threat');

        $threat = ThreatCode::whereIn('description', $threat_dec)->get();
        $maintenances = MaintenanceProcess::whereIn('name', $main_name)->orderBy('name')->get();

        $temp = [];
        foreach ($model->groupBy('threat') as $key => $val) {
           foreach ($val as $value) {
               $temp[$key][$value->maintenance] = $value->total;
           }
        }

        $result = [];
        foreach ($threat as $key) {
            foreach ($maintenances as $keys) {
                if (isset($temp[$key->description][$keys->name]) && $temp[$key->description][$keys->name] != 0)
                {
                    $result[$key->description][$keys->name] = $temp[$key->description][$keys->name];
                } else {
                    $result[$key->description][$keys->name] = 0;
                }
            }
        }

        return $result;
    }

    public function equipment(Request $request)
    {
        $filter = [];
        $group = [DB::raw('stc.id'), DB::raw('stc.description')];

        if ($request->year != null){
            $group[] = DB::raw('year(o.observation_date)');
            $filter[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
        }

        if ($request->start_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
        }

        if ($request->maintenance_process != null){
            $filter[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
        }

        $model = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        stc.id,
                        stc.description as threat,
                        count(*) as total
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->groupBy($group)
                    ->where($filter)
                    ->get();

        return $model;
    }

    public function pareto(Request $request)
    {
        $filter = [];
        $group = [DB::raw('mp.id'), DB::raw('mp.name')];

        if ($request->year != null){
            $group[] = DB::raw('year(o.observation_date)');
            $filter[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
        }

        if ($request->start_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
        }

        if ($request->maintenance_process != null){
            $filter[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
        }

        $model = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        mp.id,
                        mp.name as maintenance_process,
                        count(*) as total
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->orderBy(DB::raw('total'), 'desc')
                    ->groupBy($group)
                    ->where($filter)
                    ->get();

        $all_total = $model->sum('total');

        $cum = 0;
        foreach ($model as $key) {
            $percentage = round(($key->total / $all_total) * 100, 2);
            $cum += $percentage;

            $key->percentage = $percentage;
            $key->cumulative = $cum;
        }

        return $model;
    }
}
