<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    protected $fillable = [
        'observation_no',
        'observation_date',
        'start_time',
        'end_time',
        'subtitle',
        'due_date',
        'mp_id',
        'uic_id',
        'component_type',
        'task_observed',
        'location',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Model\User', 'observation_teams', 'observation_id', 'user_id');
    }

    public function uic()
    {
        return $this->belongsTo('App\Model\UIC', 'uic_id');
    }

    public function maintenance()
    {
        return $this->belongsTo('App\Model\MaintenanceProcess', 'mp_id');
    }
}
