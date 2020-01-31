<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Report;
use App\Model\ReportUIC;
use App\Model\UIC;
use App\Model\Distribution;
use App\Model\Recommendation;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Report::all();
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
        $model_report = new Report();
        $model_report->prepared_by = $request->prepared_by;
        $model_report->approved_by = $request->approved_by;
        $model_report->checked_by = $request->checked_by;
        $model_report->status = $request->status;
        $model_report->title = $request->title;
        $model_report->subject = $request->subject;
        $model_report->report_no = $request->report_no;
        $model_report->date = $request->date;
        $model_report->attention = $request->attention;
        $model_report->issued = $request->issued;
        $model_report->introduction = $request->introduction;
        $model_report->brief_summary = $request->brief_summary;
        $model_report->regression_analysis = $request->regression_analysis;
        $model_report->threat_error = $request->threat_error;
        $model_report->save();

        foreach($request->distribution as $dist){
            $model_report_dist = new Distribution();

            $model_report_dist->name = $dist["name"];
            $model_report_dist->report_id = $model_report->id;
            $model_report_dist->save();
        }

        foreach($request->recommendations as $recom){
            $model_uic = UIC::where('uic_code',$recom["uic"])->get();
            $model_recommendation = new Recommendation();
            
            $model_recommendation->uic_id = $model_uic[0]->getKey();
            $model_recommendation->recommendation = $recom["recommendation"];
            $model_recommendation->due_date = $recom["due_date"];
            $model_recommendation->status = $recom["status"];
            $model_recommendation->save();

            $model_temp = new ReportUIC();
            $model_temp->uic_id = $model_uic[0]->getKey();
            $model_temp->report_id = $model_report->id;
            $model_temp->save();
        }
        
        return "Store Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Report::find($id);
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
        $model = Report::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->update($request->all());
            $result->additional(['message' => 'update successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to update, Report not found!']);
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
        $model = Report::find($id);
        $result = new Result($model);

        if ($model != null)
        {
            $model->delete();
            $result->additional(['message' => 'delete successfully']);
            return $result;
        }
            else
        {
            $result->additional(['message' => 'failed to delete, Report not found!']);
            return $result;
        }
    }
    
}
