<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username',
        'password',
        'uic_id',
        'role',
        'status'
    ];

    public function uic()
    {
        return $this->belongsTo('App\Model\UIC');
    }
}
