<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Recommendation;
use App\Model\RecommendationUIC;
use App\Model\UIC;
use App\Model\Report;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $model = Recommendation::all();
        foreach($model as $rec){
            $list_uic = array();
            $model_uic = RecommendationUIC::where('recommendation_id',$rec->id)->get();
            foreach($model_uic as $uic){
                $uics = UIC::find($uic->uic_id);
                $list_uic[] = $uics->getAttribute("uic_code");
            }
            $rec->uic = $list_uic;
            $model_report = Report::find($rec->report_id);
            $rec->report_no = $model_report->getAttribute("report_no");
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
        //
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
        //
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
    public function filterOption(Request $request){
        $year = Recommendation::select(DB::raw('year(date) as year'))->distinct('date')->pluck('year');
        $month = Recommendation::select(DB::raw('month(date) as month'))->distinct('date')->pluck('month');
        $uic = UIC::select(DB::raw('uic_code as year'))->distinct('uic_code')->pluck('year');
        $status = Recommendation::select(DB::raw('status as year'))->distinct('status')->pluck('year');
        return response()->json([
            "year" => $year,
            "month" => $month,
            "uic" => $uic,
            "status" => $status,
        ]);
    }
    public function filter(Request $request){
        $model = RecommendationController::index();
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

        if ($request->search != null){
            $temp6 = array();
            foreach($result as $rep){
                if (strpos($rep->date, $request->search) !== false || strpos($rep->due_date, $request->search) !== false || strpos($rep->report_no, $request->search) !== false || strpos($rep->recommendation, $request->search) !== false  || strpos($rep->status, $request->search) !== false || in_array($request->search,$rep->uic) ){
                    $temp6[] = $rep;
                }
            }
            $result = $temp6;
        }

        return new Result($result);
    }
}
