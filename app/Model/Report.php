<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    public function uic()
    {
        return $this->belongsToMany('App\Model\UIC', 'report_uic', 'uic_id', 'report_id');
    }
}
