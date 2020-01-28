<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Model\Observation;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function safety()
    {
        // $model = Observation::select(DB::raw('count(*) as count'), 'status')->groupBy('status')->get();
        $model = Observation::all();
        return new Result($model);
    }
}
