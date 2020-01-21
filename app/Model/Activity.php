<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function sub_activities()
    {
        return $this->belongsToMany('App\Model\SubActivity', 'maintenance_process_details', 'mp_id', 'sub_activity_id');
    }
}
