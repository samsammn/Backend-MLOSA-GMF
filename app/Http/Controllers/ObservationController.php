<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Observation;
use App\Model\ObservationTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Observation::with(['observation_team'])->paginate();

        return new ResultCollection($model);
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
        $observation = Observation::find($id);
        return new Result($observation);
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

        if ($request->status != null)
        {
            $filter[] = ['status', '=', $request->status];
        }

        $model = Observation::orWhere($filter)->get();

        return new ResultCollection($model->groupBy('due_date'));
    }

    public function year()
    {
        $model = Observation::select(DB::raw('year(due_date) as year'))->distinct('due_date')->pluck('year');
        return $model;
    }

}
