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
        $filter = [];
        $search1 = [];
        $search2 = [];

        if ($request->year !== null) {
            $filter[] = [DB::raw('year(rec.date)'), '=', $request->year];
        }

        if ($request->month != null){
            $filter[] = [DB::raw('month(rec.date)'), '=', $request->month];
        }

        if ($request->uic_code != null){
            $filter[] = [DB::raw('uics.uic_code'), '=', $request->uic_code];
        }

        if ($request->status != null){
            $filter[] = [DB::raw('rec.status'), '=', $request->status];
        }

        if ($request->search != null){
            $search1[] = [DB::raw('rep.report_no'), 'LIKE', '%'.$request->search.'%'];
            $search2[] = [DB::raw('rec.recommendation'), 'LIKE', '%'.$request->search.'%'];
        }

        $model = DB::table(DB::raw('recommendations as rec'))
                    ->selectRaw('
                        rep.report_no,
                        rec.*,
                        uics.uic_code
                    ')
                    ->join(DB::raw('report rep'), 'rec.report_id', '=', 'rep.id')
                    ->join(DB::raw('uics'), 'rec.uic_id', '=', 'uics.id')
                    ->where($filter)
                    ->orWhere($search1)
                    ->orWhere($search2)
                    ->get();

        return response()->json([
            "data" => $model,
        ]);
    }
}
