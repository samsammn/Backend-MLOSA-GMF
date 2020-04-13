<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RecommendationReplies;
use App\Model\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RecommendationRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $file = $request->file;
        $filename = '';

        if ($request->file('file') !== null) {
            $path = '/recommendation_replies/';
            $filename = url('') . $path . $file->getClientOriginalName();
            $file->move(public_path($path), $file->getClientOriginalName());
        }

        $model = new RecommendationReplies();
        $model->recommendation_id = $request->recommendation_id;
        $model->user_id = $request->user_id;
        $model->reply = $request->reply;
        $model->file = $filename;
        $model->save();

        $user = User::where('username', '=', Session::get('username'))->first();
        $unit = $user->uic->uic_code;

        $notif = new NotificationController();
        $notif->addRecommendation([
            'recommendation_id' => $request->recommendation_id,
            'role' => strtolower($user->role),
            'unit' => $unit
        ]);

        return response()->json([
            'message' => 'Store Success',
            'data' => $model
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
}
