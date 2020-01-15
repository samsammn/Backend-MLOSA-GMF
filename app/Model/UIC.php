<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UIC extends Model
{
    protected $table = 'uics';

    public $timestamps = false;

    protected $fillable = [
        'uic_name',
        'uic_code'
    ];

    public function user()
    {
        return $this->hasMany('App\Model\User', 'uic_id');
    }
}
