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

    public function observation_team()
    {
        return $this->hasMany('App\Model\ObservationTeam');
    }

    public function uic()
    {
        return $this->belongsTo('App\Model\UIC');
    }
}
