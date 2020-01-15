<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaintenanceProcess extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
