<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    //
    protected $table = 'recommendations';

    protected $fillable = [
        'uic_id',
        'recommendation',
        'due_date',
        'status',
        'file',
        'created_at',
        'updated_at',
    ];
    public function uic()
    {
        return $this->hasOne('App\Model\UIC', 'uic_id');
    }
}
