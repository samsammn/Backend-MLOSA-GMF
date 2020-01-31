<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    //
    protected $table = "distributions";
    protected $fillable = [
        'name',
        'report_id'
    ];
    public $timestamps = false;
}
