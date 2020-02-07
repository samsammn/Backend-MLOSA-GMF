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
use App\Model\RecommendationReplies;
use App\Model\RecommendationUIC;
use Illuminate\Support\Facades\DB;

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
        foreach($model as $report){
            $list_uic = array();
            $model_uic = ReportUIC::where('report_id',$report->id)->get();
            foreach($model_uic as $uic){
                $uics = UIC::find($uic->uic_id);
                $list_uic[] = $uics->getAttribute("uic_code");
            }
            $report->uic = $list_uic;
            $model_recommendation = Recommendation::where('report_id',$report->id)->get();
            $count = 0;
            $overdue = false;
            $on_progress = false;
            foreach ($model_recommendation as $recom){
                if ($recom->status == "Closed"){
                    $count = $count + 1;
                }
                if ($recom->status == "On Progress"){
                    $on_progress = true;
                }
                if ($recom->status == "Overdue"){
                    $overdue = true;
                }
            }
            if ($count == sizeof($model_recommendation)){
                $status = "Closed";
            }else if($overdue){
                $status = "Overdue";
            }else if($on_progress){
                $status = "On Progress";
            }else{
                $status = "Open";
            }
            $report->recom_status = $status;
            
        }
        
        return response()->json([
            "data" => $model,
        ]);
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

        $uics = array();
        foreach($request->recommendations as $recom){
            $model_recommendation = new Recommendation();
            $model_recommendation->recommendation = $recom["recommendation"];
            $model_recommendation->date = now();
            $model_recommendation->due_date = $recom["due_date"];
            $model_recommendation->status = $recom["status"];
            $model_recommendation->report_id = $model_report->id;
            $model_recommendation->save();

            foreach($recom["uic"] as $uic){
                $model_uic = UIC::where('uic_code',$uic)->get();
                $model_rec_uic = new RecommendationUIC();
                $model_rec_uic->recommendation_id = $model_recommendation->id;
                $model_rec_uic->uic_id = $model_uic[0]->getKey();
                $model_rec_uic->save();
                if (!in_array($uic,$uics)){
                    $model_temp = new ReportUIC();
                    $model_temp->uic_id = $model_uic[0]->getKey();
                    $model_temp->report_id = $model_report->id;
                    $model_temp->save();
                    $uics[] = $uic;
                }
            }
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
        $list_uic = array();
        $model_uic = ReportUIC::where('report_id',$id)->get();
        foreach($model_uic as $uic){
            $uics = UIC::find($uic->uic_id);
            $list_uic[] = $uics->getAttribute("uic_code");
        }
        $model->uic = $list_uic;

        $list_uic = array();
        $recommendation = Recommendation::where('report_id',$id)->get();
        foreach($recommendation as $rec){
            $model_uic = RecommendationUIC::where('recommendation_id',$rec->id)->get();
                foreach($model_uic as $uic){
                    $uics = UIC::find($uic->uic_id);
                    $list_uic[] = $uics->getAttribute("uic_code");
                }
            $rec->uic = $list_uic;
            $model_report = Report::find($rec->report_id);
            $rec->report_no = $model_report->getAttribute("report_no");
            $model_replies = RecommendationReplies::where('recommendation_id',$rec->id)->get();
            $rec->replies = $model_replies;
        }
        
        $model->recommendation = $recommendation;
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

    public function filterOption(Request $request){
        $year = Report::select(DB::raw('year(date) as year'))->distinct('date')->pluck('year');
        $month = Report::select(DB::raw('month(date) as month'))->distinct('date')->pluck('month');
        $uic = UIC::select(DB::raw('uic_code as year'))->distinct('uic_code')->pluck('year');
        $status = Report::select(DB::raw('status as year'))->distinct('status')->pluck('year');
        $report = ReportController::index();
        $recom_status = array();
        foreach($report->getData() as $rep){
            foreach($rep as $r){
                if(!in_array($r->recom_status,$recom_status)){
                    $recom_status[] = $r->recom_status;
                }
            }
        }
        return response()->json([
            "year" => $year,
            "month" => $month,
            "uic" => $uic,
            "status" => $status,
            "recom_status" => $recom_status
        ]);
    }

    public function filter(Request $request){
        $model = ReportController::index();
        $result = array();
        if ($request->year != null)
        {
            $temp1 = array();
            foreach ($model->getData() as $r){
                foreach($r as $rep){
                    if (date('Y', strtotime($rep->date)) == $request->year){
                        $temp1[] = $rep;
                    }
                }
            }
            $result = $temp1;
        }else{
            foreach ($model->getData() as $r){
                $result = $r;
            }
        }
        if ($request->month != null)
        {
            $temp2 = array();
            foreach($result as $rep){
                if (date('m', strtotime($rep->date)) == $request->month){
                    $temp2[] = $rep;
                }
            }
            $result = $temp2;
        }
        if ($request->uic_code != null)
        {
            $temp3 = array();
            foreach($result as $rep){
                if (in_array($request->uic_code,$rep->uic)){
                    $temp3[] = $rep;
                }
            }
            $result = $temp3;
        }
        if ($request->status != null)
        {
            $temp4 = array();
            foreach($result as $rep){
                if ($rep->status == $request->status){
                    $temp4[] = $rep;
                }
            }
            $result = $temp4;
        }
        if ($request->recom_status != null)
        {
            $temp5 = array();
            foreach($result as $rep){
                if ($rep->recom_status == $request->recom_status){
                    $temp5[] = $rep;
                }
            }
            $result = $temp5;
        }

        if ($request->search != null){
            $temp6 = array();
            foreach($result as $rep){
                if (strpos($rep->date, $request->search) !== false || strpos($rep->report_no, $request->search) !== false || strpos($rep->prepared_by, $request->search) !== false  || strpos($rep->approved_by, $request->search) !== false || strpos($rep->checked_by, $request->search) !== false ||strpos($rep->status, $request->search) !== false || in_array($request->search,$rep->uic) || strpos($rep->recom_status, $request->search) !== false ){
                    $temp6[] = $rep;
                }
            }
            $result = $temp6;
        }

        return new Result($result);
    }
    
}
