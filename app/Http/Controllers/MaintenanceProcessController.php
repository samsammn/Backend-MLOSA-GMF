<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\MaintenanceProcess;
use Illuminate\Http\Request;

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

        $model = MaintenanceProcess::create($request->all());
        return new Result($model);
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
        $model = MaintenanceProcess::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->update($request->all());
            $result->additional(['message' => 'update successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to update, uic not found!']);
            return $result;
        }
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
            $result->additional(['message' => 'delete successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to delete, maintenance process not found!']);
            return $result;
        }
    }
}
