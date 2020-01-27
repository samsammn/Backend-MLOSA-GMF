<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Activity;
use App\Model\MaintenanceProcess;
use App\Model\MaintenanceProcessDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MaintenanceProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = MaintenanceProcess::all();
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
        $request->validate([
            'name' => 'required',
        ]);

        $maintenance = new MaintenanceProcess();
        $maintenance->name = $request->name;
        $maintenance->save();

        foreach ($request->activities as $activity) {
            foreach ($activity['sub_activities'] as $sub) {
                $data = new MaintenanceProcessDetail();
                $data->mp_id = $maintenance->id;
                $data->activity_id = $activity['id'];
                $data->sub_activity_id = $sub['id'];

                $model[] = $data->toArray();
            }
        }

        $detail = MaintenanceProcessDetail::insert($model);

        return response()->json([
            'message' => 'Observation Form has been created successfullty'
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
        $model = MaintenanceProcess::find($id);
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
    public function update($id, Request $request)
    {
        $maintenance = MaintenanceProcess::find($id);
        $maintenance->name = $request->name;
        $maintenance->save();

        $maintenance_detail = MaintenanceProcessDetail::where('mp_id', '=', $id);
        $maintenance_detail->delete();

        foreach ($request->activities as $activity) {
            foreach ($activity['sub_activities'] as $sub) {
                $data = new MaintenanceProcessDetail();
                $data->mp_id = $maintenance->id;
                $data->activity_id = $activity['id'];
                $data->sub_activity_id = $sub['id'];

                $model[] = $data->toArray();
            }
        }

        MaintenanceProcessDetail::insert($model);
        $result = new Result([
            'message' => 'update successfully'
        ]);

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = MaintenanceProcess::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->delete();

            $detail = MaintenanceProcessDetail::where('mp_id', '=', $id);
            if ($detail != null){
                $detail->delete();
            }

            $result->additional(['message' => 'delete successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to delete, observation form not found!']);
            return $result;
        }
    }

    public function form($id)
    {
        $maintenance = MaintenanceProcess::find($id);
        $model = DB::select('select activity, sub_activity_id, sub_activity from vw_maintenance_process_relation where id="'.$id.'"');
        $data = collect($model)->groupBy('activity');

        return new Result([
            'maintenance' => $maintenance,
            'detail' => $data
        ]);
    }
}
