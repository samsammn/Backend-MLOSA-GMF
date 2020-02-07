<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Model\RiskColor;
use App\Model\RiskIndex;
use App\Model\RiskProbability;
use App\Model\RiskSeverity;
use App\RiskAcceptability;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use stdClass;

class RiskController extends Controller
{
    public function index()
    {
        $client = new Client();
        $headers = [
            'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4'
        ];

        $response = $client->get('http://172.16.40.164/API/Risk_Index', [
            'headers' => $headers
        ]);

        $body = json_decode($response->getBody(), true);
        $severity = collect($body['severity_of_occurence'])->groupBy('aviation')->toArray();

        $data_probability = $body['probability_of_occurence'];
        $data_color = $body['color_risk_index'];

        $data_severity = [];
        foreach ($severity as $key => $item) {
            $data = [];
            foreach ($item as $val) {
                $occurance = strtolower(str_replace( ' ', '_', $val['occurance']));

                $data['code'] = $val['value'];
                $data['aviation'] = $val['aviation'];
                $data[$occurance] = $val['ket'];
            }
            $data_severity[] = $data;
        }

        $data_color_risk_index = [];
        foreach ($data_color as $key) {
            $acceptability = RiskAcceptability::where('tolerability','=', $key['severity'])->first();
            $risk_index = RiskIndex::where('risk_acceptability_id','=', $acceptability->id)->pluck('value');

            Arr::set($key, 'risk_index', $risk_index);
            $data_color_risk_index[] = $key;
        }

        return response()->json([
            'probability_of_occurence' => $data_probability,
            'severity_of_occurence' => $data_severity,
            'color_risk_index' => $data_color_risk_index
        ]);
    }

    // method-method dummy
    public function risk()
    {
        $probability = RiskProbability::all();
        foreach ($probability as $value) {
            $value->meaning = unserialize($value->meaning);
        }

        $severity = RiskSeverity::all();
        foreach ($severity as $value) {
            $value->people = unserialize($value->people);
            $value->environment = unserialize($value->environment);
            $value->security = unserialize($value->security);
            $value->asset = unserialize($value->asset);
            $value->operational = unserialize($value->operational);
            $value->it_system = unserialize($value->it_system);
            $value->reputational = unserialize($value->reputational);
        }

        $risk_color = RiskColor::all();

        return response()->json([
            'probability' => $probability,
            'severity' => $severity,
            'risk_colors' => $risk_color
        ]);
    }

    public function get_probability()
    {
        $data = RiskProbability::all();
        foreach ($data as $value) {
            $value->meaning = unserialize($value->meaning);
        }

        return $data;
    }

    public function add_probability(Request $request)
    {
        $data = new RiskProbability();
        $data->definition = $request->definition;
        $data->meaning = serialize($request->meaning);
        $data->value = $request->value;
        $data->save();

        return $data;
    }

    public function get_severity()
    {
        $data = RiskSeverity::all();

        foreach ($data as $value) {
            $value->people = unserialize($value->people);
            $value->environment = unserialize($value->environment);
            $value->security = unserialize($value->security);
            $value->asset = unserialize($value->asset);
            $value->operational = unserialize($value->operational);
            $value->it_system = unserialize($value->it_system);
            $value->reputational = unserialize($value->reputational);
        }

        return $data;
    }

    public function add_severity(Request $request)
    {
        $data = new RiskSeverity();

        $data->code = $request->code;
        $data->aviation = $request->aviation;
        $data->people = serialize($request->people);
        $data->environment = serialize($request->environment);
        $data->security = serialize($request->security);
        $data->asset = serialize($request->asset);
        $data->operational = serialize($request->operational);
        $data->it_system = serialize($request->it_system);
        $data->reputational = serialize($request->reputational);
        $data->save();

        return $data;
    }
}
