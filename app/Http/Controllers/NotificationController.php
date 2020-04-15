<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result;
use App\Model\NotificationObservation;
use App\Model\NotificationRecommendation;
use App\Model\NotificationReport;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::where('username', '=', Session::get('username'))->with('uic')->first();
        $role = strtolower($user->role);

        if ($role !== 'mgr' && $role !== 'gm') {
            if ($role === 'admin') {
                $observation = NotificationObservation::where($role, '>', 0)->count();
                $recommendation = NotificationRecommendation::where($role, '>', 0)->count();
            } else {
                $observation = NotificationObservation::where($role, '>', 0)->where('unit', '=', $user->uic->uic_code)->count();
                $recommendation = NotificationRecommendation::where($role, '>', 0)->where('unit', '=', $user->uic->uic_code)->count();
            }
        } else {
            $observation = 0;
            $recommendation = 0;
        }

        if ($role === 'admin') {
            $report = NotificationReport::where($role, '>', 0)->distinct('report_id')->count('pid');
        } else {
            $report = NotificationReport::where($role, '>', 0)->where('unit', '=', $user->uic->uic_code)->count();
        }

        return new Result([
            'observation' => $observation,
            'report' => $report,
            'recommendation' => $recommendation
        ]);
    }

    public function readAll($notif)
    {
        $user = User::where('username', '=', Session::get('username'))->with('uic')->first();
        $role = strtolower($user->role);

        if ($notif === 'observation') {
            if ($role !== 'gm' && $role !== 'mgr') {
                NotificationObservation::query()->update([
                    $role => 0
                ]);
            }
        } else if ($notif === 'report') {
            NotificationReport::query()->where('unit', '=', $user->uic->uic_code)->update([
                $role => 0
            ]);
        } else if ($notif === 'recommendation') {
            if ($role !== 'gm' && $role !== 'mgr') {
                NotificationRecommendation::query()->update([
                    $role => 0
                ]);
            }
        }
    }

    public function addObservation($data)
    {
        $role_notif = [
            'admin' => 'uic',
            'uic' => 'admin'
        ];

        $is_role = $role_notif[$data['role']];
        $unit = $data['unit'];

        $notif = new NotificationObservation();
        $notif->observation_id = $data['observation_id'];
        $notif->$is_role = 1;
        $notif->unit = $unit;
        $notif->save();
    }

    public function updateObservation($data)
    {
        $is_role = $data['role'];

        $notif = NotificationObservation::where('observation_id', '=', $data['observation_id'])->first();
        $notif->$is_role = 0;
        $notif->save();
    }

    public function addReport($data)
    {
        $status = $data['status'];
        if ($status === 'Revised') {
            $role_notif = [
                'admin' => 'mgr',
                'mgr' => 'admin',
                'gm' => 'admin'
            ];
        } else {
            $role_notif = [
                'admin' => 'mgr',
                'mgr' => 'gm',
                'gm' => 'uic'
            ];
        }

        $is_role = $role_notif[$data['role']];
        $report = NotificationReport::where('report_id', '=', $data['report_id'])->first();

        if ($report !== null) {
            foreach ($data['unit'] as $unit) {
                $reports = NotificationReport::where('report_id', '=', $data['report_id'])->where('unit', '=', $unit)->first();
                $reports->$is_role = 1;
                $reports->unit = $unit;
                $reports->save();
            }
        } else {
            foreach ($data['unit'] as $unit) {
                $notif = new NotificationReport();
                $notif->report_id = $data['report_id'];
                $notif->$is_role = 1;
                $notif->unit = $unit;
                $notif->save();
            }
        }
    }

    public function addRecommendation($data)
    {
        $role_notif = [
            'admin' => 'uic',
            'uic' => 'admin'
        ];

        $is_role = $role_notif[$data['role']];
        $unit = $data['unit'];

        $notif = new NotificationRecommendation();
        $notif->recommendation_id = $data['recommendation_id'];
        $notif->$is_role = 1;
        $notif->unit = $unit;
        $notif->save();
    }
}
