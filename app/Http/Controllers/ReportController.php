<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Result;
use App\Http\Resources\ResultCollection;
use App\Model\Report;
use App\Model\UIC;
use App\Model\Distribution;
use App\Model\Recommendation;
use App\Model\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = [];
        $filterRecom = [];

        if ($request->year != null) {
            $filter[] = [DB::raw('year(date)'), '=', $request->year];
        }

        if ($request->month != null) {
            $filter[] = [DB::raw('month(date)'), '=', $request->month];
        }

        if ($request->uic_code != null) {
            $filterRecom[] = ['uic_code', '=', $request->uic_code];
        }

        if ($request->status != null) {
            $filter[] = ['status', '=', $request->status];
        }

        if ($request->recom_status != null) {
            $filterRecom[] = ['status', '=', $request->recom_status];
        }

        $report_id = Recommendation::selectRaw('
                    recommendations.report_id,
                    recommendations.uic_id,
                    uics.uic_code
                ')
                ->join('uics', 'uics.id', '=', 'recommendations.uic_id')
                ->where($filterRecom)
                ->groupBy('recommendations.report_id', 'recommendations.uic_id', 'uics.uic_code')
                ->pluck('report_id');

        $model = Report::where($filter)->whereIn('id', $report_id)->get();

        foreach ($model as $report) {
            $report->uic = Recommendation::selectRaw('uics.*')
                ->join('uics', 'uics.id', '=', 'recommendations.uic_id')
                ->where('report_id', $report->id)
                ->get();
        }

        $notif = new NotificationController();
        $notif->readAll('report');

        return new Result($model);
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
        // get user
        $user = User::where('username', '=', Session::get('username'))->first();

        // get role user
        $role = $user->role;
        // $role = $request->role;

        // get recommendations remarks acummulate
        $recommendation_remarks = '';
        foreach ($request->recommendations as $recom) {
            $recommendation_remarks .= $recom["recommendation_remarks"];
        }

        $model_report = new Report();

        // cek remarks condition for status
        if ($request->action == 'Save') {
            $status = 'Draft';
        } else if ($request->action == 'Submit') {
            if ($request->introduction_remarks !== null || $request->brief_summary_remarks !== null || $request->regression_analysis_remarks !== null || $request->threat_error_remarks !== null || $recommendation_remarks !== '') {
                if ($role == 'MGR' || $role == 'GM') {
                    $status = 'Revised';
                } else {
                    $status = 'Need Checking';
                }
            } else {
                if ($role == 'MGR') {
                    $status = 'Need Approval';
                } else if ($role == 'GM') {
                    $status = 'Approved';
                } else {
                    $status = 'Need Checking';
                }
            }
        } else {
            $status = '';
        }

        if ($request->report_id !== null) {
            $model_report->exists = true;
            $model_report->id = $request->report_id;
            $msg = 'Report updated successfully';
        } else {
            $msg = 'Report inserted successfully';
        }

        $model_report->report_no = $request->report_no;
        $model_report->user_id = $user->id;
        $model_report->prepared_by = $request->prepared_by;
        $model_report->approved_by = $request->approved_by;
        $model_report->checked_by = $request->checked_by;
        $model_report->status = $status;
        $model_report->title = $request->title;
        $model_report->subject = $request->subject;
        $model_report->date = $request->date;
        $model_report->attention = $request->attention;
        $model_report->issued = $request->issued;
        $model_report->introduction = $request->introduction;
        $model_report->introduction_remarks = $request->introduction_remarks;
        $model_report->brief_summary = $request->brief_summary;
        $model_report->brief_summary_remarks = $request->brief_summary_remarks;
        $model_report->regression_analysis = $request->regression_analysis;
        $model_report->regression_analysis_remarks = $request->regression_analysis_remarks;
        $model_report->threat_error = $request->threat_error;
        $model_report->threat_error_remarks = $request->threat_error_remarks;
        $model_report->save();

        foreach ($request->distribution as $dist) {
            $model_report_dist = new Distribution();

            $model_report_dist->name = $dist["name"];
            $model_report_dist->report_id = $model_report->id;
            $model_report_dist->save();
        }

        $unit_id = [];
        foreach ($request->recommendations as $recom) {
            foreach ($recom['uic_id'] as $uic_id) {
                $model_recommendation = new Recommendation();
                if ($recom['recommendation_id'] !== null) {
                    $model_recommendation->exists = true;
                    $model_recommendation->id = $recom['recommendation_id'];
                }
                $model_recommendation->recommendation = $recom["recommendation"];
                $model_recommendation->recommendation_remarks = $recom["recommendation_remarks"];
                $model_recommendation->date = now();
                $model_recommendation->due_date = $recom["due_date"];
                $model_recommendation->status = $recom["status"];
                $model_recommendation->report_id = $model_report->id;
                $model_recommendation->uic_id = $uic_id;
                $model_recommendation->save();
                $unit_id[] = $uic_id;
            }
        }

        $unit_code = UIC::whereIn('id', $unit_id)->pluck('uic_code')->toArray();

        $notif = new NotificationController();
        $notif->addReport([
            'report_id' => $model_report->id,
            'role' => strtolower($user->role),
            'unit' => $unit_code,
            'status' => $status
        ]);

        return response()->json([
            'message' => $msg,
            'report_id' => $model_report->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model = Report::find($id);
        $model->uic = Recommendation::selectRaw('uics.*')
            ->join('uics', 'uics.id', '=', 'recommendations.uic_id')
            ->where('report_id', $id)
            ->get();

        $model->recommendation = Recommendation::with('uic', 'replies')->where('report_id', '=', $id)->where('uic_id', '=', $request->uic_id)->get();

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

        if ($model != null) {
            $model->update($request->all());
            $result->additional(['message' => 'update successfully']);
            return $result;
        } else {
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

        if ($model != null) {
            $model->delete();
            $result->additional(['message' => 'delete successfully']);
            return $result;
        } else {
            $result->additional(['message' => 'failed to delete, Report not found!']);
            return $result;
        }
    }

    public function filterOption(Request $request)
    {
        $year = Report::select(DB::raw('year(date) as year'))->distinct('date')->pluck('year');
        $month = Report::select(DB::raw('month(date) as month'))->distinct('date')->pluck('month');
        $uic = UIC::select(DB::raw('uic_code as year'))->distinct('uic_code')->pluck('year');
        $status = Report::select(DB::raw('status as year'))->distinct('status')->pluck('year');
        $report = ReportController::index();
        $recom_status = array();
        foreach ($report->getData() as $rep) {
            foreach ($rep as $r) {
                if (!in_array($r->recom_status, $recom_status)) {
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

    public function filter(Request $request)
    {
        $model = ReportController::data();

        $result = array();
        if ($request->year != null) {
            $temp1 = array();
            foreach ($model as $r) {
                foreach ($r as $rep) {
                    if (date('Y', strtotime($rep->date)) == $request->year) {
                        $temp1[] = $rep;
                    }
                }
            }
            $result = $temp1;
        } else {
            foreach ($model as $r) {
                $result = $r;
            }
        }
        if ($request->month != null) {
            $temp2 = array();
            foreach ($result as $rep) {
                if (date('m', strtotime($rep->date)) == $request->month) {
                    $temp2[] = $rep;
                }
            }
            $result = $temp2;
        }
        if ($request->uic_code != null) {
            $temp3 = array();
            foreach ($result as $rep) {
                if (in_array($request->uic_code, $rep->uic)) {
                    $temp3[] = $rep;
                }
            }
            $result = $temp3;
        }
        if ($request->status != null) {
            $temp4 = array();
            foreach ($result as $rep) {
                if ($rep->status == $request->status) {
                    $temp4[] = $rep;
                }
            }
            $result = $temp4;
        }
        if ($request->recom_status != null) {
            $temp5 = array();
            foreach ($result as $rep) {
                if ($rep->recom_status == $request->recom_status) {
                    $temp5[] = $rep;
                }
            }
            $result = $temp5;
        }

        if ($request->search != null) {
            $temp6 = array();
            foreach ($result as $rep) {
                if (strpos($rep->date, $request->search) !== false || strpos($rep->report_no, $request->search) !== false || strpos($rep->prepared_by, $request->search) !== false  || strpos($rep->approved_by, $request->search) !== false || strpos($rep->checked_by, $request->search) !== false || strpos($rep->status, $request->search) !== false || in_array($request->search, $rep->uic) || strpos($rep->recom_status, $request->search) !== false) {
                    $temp6[] = $rep;
                }
            }
            $result = $temp6;
        }

        return new Result($result);
    }

    public function upload_file_editor(Request $request)
    {
        $file = $request->file('file');

        if ($request->file('file') == null) {
            return response()->json([
                'message' => 'Upload gagal, file tidak ada!'
            ]);
        }

        $path = "/reports/";
        $file->move(public_path($path),  $file->getClientOriginalName());

        $loc = url('') . $path . $file->getClientOriginalName();
        return response()->json([
            'message' => 'Upload berhasil!',
            'image_url' => $loc
        ]);
    }

    public function test_email()
    {
        $report = Report::find(5);
        $data = [
            'to' => 'samsam.nursamsi02@gmail.com',
            'cc' => ['sam.sesterdamp02@gmail.com'],
            'from' => Config::get('mail.from.address'),
            'from_name' => Config::get('mail.from.name'),
            'subject' => $report->subject
        ];

        Mail::send('emails.report', $data, function ($message) use ($data) {
            $message->to($data['to']);
            $message->cc($data['cc']);
            $message->from($data['from'], $data['from_name']);
            $message->subject($data['subject']);
        });
        return 'Email Sent';
    }

    public function distribution()
    {
        $client = new Client();
        $headers = [
            'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4'
            // 'username' => $username,
        ];

        $response = $client->get('http://172.16.40.164/API/Superior_email', [
            'headers' => $headers
        ]);

        $body = json_decode($response->getBody(), true);
        return $response->getBody();
    }

    public function attachment(Request $request)
    {
        $model = Report::find($request->id);

        $data = [
            'report' => $model
        ];

        set_time_limit(300);
        $pdf = PDF::loadView('pdf.report', ['data' => $data]);

        return $pdf->stream('report.pdf');
    }
}
