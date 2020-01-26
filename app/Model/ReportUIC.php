<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportUIC extends Model
{
    //
    protected $table = 'report_uic';

    protected $fillable = [
        'uic_id',
        'report_id',
    ];
}
