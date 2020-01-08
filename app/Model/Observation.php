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
        'due_date',
        'mp_id',
        'component_type',
        'task_observed',
        'location',
    ];
}
