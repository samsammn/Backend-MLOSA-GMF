<?php

namespace App\Http\Controllers;

use App\Model\MaintenanceProcess;
use App\Model\SafetyRisk;
use App\Model\ThreatCode;
use App\Model\UIC;
use App\RiskAcceptability;
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

    public function risk_register(Request $request)
    {
        $filter = [];
        $filter_corporate = [];
        $group = [DB::raw('ra.tolerability'), DB::raw('ra.index')];
        $group_risk_dimension = [DB::raw('maintenance')];
        $group_rvd = [DB::raw('ra.tolerability'), DB::raw('ra.index'), DB::raw('tc.description')];
        $group_ts = [DB::raw('ra.tolerability'), DB::raw('ra.index'), DB::raw('uic.uic_code')];

        if ($request->year != null){
            $group[] = DB::raw('year(o.observation_date)');
            $filter[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
            $filter_corporate[] = [DB::raw('year(o.observation_date)'), '=', $request->year];
        }

        if ($request->start_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
            $filter_corporate[] = [DB::raw('month(o.observation_date)'), '>=', $request->start_month];
        }

        if ($request->end_month != null){
            $group[] = DB::raw('MONTH(o.observation_date)');
            $filter[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
            $filter_corporate[] = [DB::raw('month(o.observation_date)'), '<=', $request->end_month];
        }

        if ($request->maintenance_process != null){
            $filter[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
            $filter_corporate[] = [DB::raw('mp.name'), '=', $request->maintenance_process];
        }

        if ($request->risk_value != null){
            $filter[] = [DB::raw('ra.tolerability'), '=', $request->risk_value];
        }

        // model corporate_current_risk
        $ccr = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        SUM(case when od.risk_value >= 1 and od.risk_value <= 174 then 1 else 0 end) as "1-174 Negligible Risk",
                        SUM(case when od.risk_value >= 175 and od.risk_value <= 349 then 1 else 0 end) as "175-349 Low Risk",
                        SUM(case when od.risk_value >= 350 and od.risk_value <= 549 then 1 else 0 end) as "350-549 Medium Risk",
                        SUM(case when od.risk_value >= 550 and od.risk_value <= 749 then 1 else 0 end) as "550-749 High Risk",
                        SUM(case when od.risk_value >= 750 and od.risk_value <= 1000 then 1 else 0 end) as "750-1000 Extreme Risk"
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('risk_indices as ri'), 'ri.value', '=', 'od.risk_index')
                    ->join(DB::raw('risk_acceptabilities as ra'), 'ra.id', '=', 'ri.risk_acceptability_id')
                    ->where($filter_corporate)
                    ->first();

        // model corporate_proposed_risk
        $cpr = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        SUM(case when od.propose_risk_value >= 1 and od.propose_risk_value <= 174 then 1 else 0 end) as "1-174 Negligible Risk",
                        SUM(case when od.propose_risk_value >= 175 and od.propose_risk_value <= 349 then 1 else 0 end) as "175-349 Low Risk",
                        SUM(case when od.propose_risk_value >= 350 and od.propose_risk_value <= 549 then 1 else 0 end) as "350-549 Medium Risk",
                        SUM(case when od.propose_risk_value >= 550 and od.propose_risk_value <= 749 then 1 else 0 end) as "550-749 High Risk",
                        SUM(case when od.propose_risk_value >= 750 and od.propose_risk_value <= 1000 then 1 else 0 end) as "750-1000 Extreme Risk"
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('risk_indices as ri'), 'ri.value', '=', 'od.risk_index_actual')
                    ->join(DB::raw('risk_acceptabilities as ra'), 'ra.id', '=', 'ri.risk_acceptability_id')
                    ->where($filter_corporate)
                    ->first();

        // model risk_dimension_distribution
        $rdd = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        mp.name as maintenance,
                        count(*) as count
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('risk_indices as ri'), 'ri.value', '=', 'od.risk_index')
                    ->join(DB::raw('risk_acceptabilities as ra'), 'ra.id', '=', 'ri.risk_acceptability_id')
                    ->groupBy($group_risk_dimension)
                    ->where($filter)
                    ->get();

        $mp = MaintenanceProcess::all();

        $temp_rdd = [];
        foreach ($rdd as $key) {
            $temp_rdd[$key->maintenance] = $key->count;
        }

        $result_rdd = [];
        foreach ($mp as $key) {
            foreach ($temp_rdd as $keys) {
                if (isset($temp_rdd[$key->name]) && $temp_rdd[$key->name] != 0)
                {
                    $result_rdd[$key->name] = $temp_rdd[$key->name];
                } else {
                    $result_rdd[$key->name] = 0;
                }
            }
        }

        // model risk_value_dist
        $rvd = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        ra.tolerability as category,
                        ra.index as risk_value,
                        tc.description,
                        count(*) as count
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->join(DB::raw('risk_indices as ri'), 'ri.value', '=', 'od.risk_index')
                    ->join(DB::raw('risk_acceptabilities as ra'), 'ra.id', '=', 'ri.risk_acceptability_id')
                    ->groupBy($group_rvd)
                    ->where($filter)
                    ->get();

        $tc = ThreatCode::all();
        $ra = RiskAcceptability::all();

        $result_rvd = [];
        foreach ($tc as $key) {
            $key_rvd = [];
            foreach ($ra as $keys) {
                $key_rvd[$keys->tolerability] = 0;
            }
            $result_rvd[$key->description] = $key_rvd;
        }

        foreach ($rvd as $key) {
            $result_rvd[$key->description][$key->category] = $key->count;
        }

        // model threat_subject
        $ts = DB::table(DB::raw('observations as o'))
                    ->selectRaw('
                        ra.tolerability as category,
                        ra.index as risk_value,
                        uic.uic_code,
                        count(*) as count
                    ')
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('uics as uic'), 'uic.id', '=', 'o.uic_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->join(DB::raw('risk_indices as ri'), 'ri.value', '=', 'od.risk_index')
                    ->join(DB::raw('risk_acceptabilities as ra'), 'ra.id', '=', 'ri.risk_acceptability_id')
                    ->groupBy($group_ts)
                    ->where($filter)
                    ->get();

        $uic = UIC::all();
        $ra = RiskAcceptability::all();

        $result_ts = [];
        foreach ($uic as $key) {
            $key_ts = [];
            foreach ($ra as $keys) {
                $key_ts[$keys->tolerability] = 0;
            }
            $result_ts[$key->uic_code] = $key_ts;
        }

        foreach ($ts as $key) {
            $result_ts[$key->uic_code][$key->category] = $key->count;
        }

        return response()->json([
            'corporate_current_risk' => $ccr,
            'corporate_proposed_risk' => $cpr,
            'risk_dimension_distribution' => $result_rdd,
            'risk_value_dist' => $result_rvd,
            'theat_subject' => $result_ts
        ]);
    }
}
