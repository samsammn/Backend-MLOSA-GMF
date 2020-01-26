<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $table = 'report';

    protected $fillable = [
        'prepared_by',
        'checked_by',
        'approved_by',
        'status',
        'title',
        'subject',
        'report_no',
        'date',
        'attention',
        'issued',
        'distribution',
        'introduction',
        'brief_summary',
        'regression_analysis',
        'threat_error',
        'created_at',
        'updated_at',
    ];
    public function uic()
    {
        return $this->belongsToMany('App\Model\UIC', 'report_uic', 'uic_id', 'report_id');
    }
}
