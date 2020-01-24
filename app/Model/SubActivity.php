<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubActivity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description'
    ];
}
