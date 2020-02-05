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

    public function details()
    {
        return $this->hasMany('App\Model\ObservationDetail', 'observation_id');
    }

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

    public function scopeSearch($query, $q)
    {
        if ($q == null) return $query;
        return $query
                    ->where('subtitle', 'LIKE', '%'.$q.'%')
                    ->orWhere('component_type', 'LIKE', '%'.$q.'%')
                    ->orWhere('task_observed', 'LIKE', '%'.$q.'%')
                    ->orWhere('location', 'LIKE', '%'.$q.'%');
    }
}
