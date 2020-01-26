<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Model\ThreatCode;
use Illuminate\Http\Request;

class ThreatCodeController extends Controller
{
    public function all_relation()
    {
        $model = ThreatCode::with('sub_threat_code')->get();
        return new Result($model);
    }
}
