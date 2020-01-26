<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThreatCode extends Model
{
    public function sub_threat_code()
    {
        return $this->hasMany('App\Model\SubThreatCode', 'threat_codes_id');
    }
}
