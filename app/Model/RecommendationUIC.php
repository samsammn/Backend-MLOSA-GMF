<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RecommendationUIC extends Model
{
    //
    protected $table = 'recommendation_uic';

    protected $fillable = [
        'uic_id',
        'recommendation_id',
    ];
}
