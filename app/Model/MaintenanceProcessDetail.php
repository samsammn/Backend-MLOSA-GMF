<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaintenanceProcessDetail extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'mp_id',
        'activity_id',
        'sub_activity_id'
    ];
}
