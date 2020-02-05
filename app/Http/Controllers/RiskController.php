<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Model\RiskColor;
use App\Model\RiskProbability;
use App\Model\RiskSeverity;
use Illuminate\Http\Request;

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

        if ($body == [])
        {
            $data = [];
        } else {
            $data = $body[0];
        }

        return $data;
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
