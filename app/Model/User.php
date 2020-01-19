<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'username',
        'fullname',
        'position',
        'uic_id',
        'role',
        'status',
        'obslicense',
        'photo'
    ];

    public function uic()
    {
        return $this->belongsTo('App\Model\UIC');
    }
}
