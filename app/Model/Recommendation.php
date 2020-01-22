<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    //
    public function uic()
    {
        return $this->hasOne('App\Model\UIC', 'uic_id');
    }
}
