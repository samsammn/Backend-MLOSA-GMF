<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaintenanceProcess extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function activities()
    {
        return $this->belongsToMany('App\Model\Activity', 'maintenance_process_details', 'mp_id', 'activity_id');
    }
}
