<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function sub_activities()
    {
        return $this->hasMany(
            'App\Model\MaintenanceProcessDetail',
            'activity_id'
            //'activity_id'
        );
    }

}
