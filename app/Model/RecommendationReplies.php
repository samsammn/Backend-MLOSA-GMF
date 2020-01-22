<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationReplies extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function report()
    {
        return $this->belongsTo('App\Model\Report', 'report_id');
    }
}
