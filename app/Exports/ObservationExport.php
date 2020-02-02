<?php

namespace App\Exports;

use App\Model\Observation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ObservationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
    }

    public function collection()
    {
        return DB::table(DB::raw('observations as o'))
                    ->select(DB::raw("
                        o.observation_no,
                        o.observation_date,
                        o.start_time,
                        o.end_time,
                        o.component_type,
                        o.task_observed,
                        mp.name as maintenance_process,
                        GROUP_CONCAT(user.fullname, ' '),
                        o.location,
                        a.name,
                        sa.description,
                        od.safety_risk,
                        concat(tc. code, '. ', tc.description) threat,
                        concat(stc. code, '. ', stc.description) as sub_threat,
                        od.effectively_managed,
                        if(od.error_outcome = 1, 'Insequential', if(od.error_outcome = 2, 'Undesired state', 'Additional error')) as error_outcome,
                        od.remark
                    "))
                    ->join(DB::raw('observation_details as od'), 'od.observation_id', '=', 'o.id')
                    ->join(DB::raw('maintenance_processes as mp'), 'mp.id', '=', 'o.mp_id')
                    ->join(DB::raw('maintenance_process_details as mpd'), 'mpd.mp_id', '=', 'mp.id')
                    ->join(DB::raw('activities as a'), 'a.id', '=', 'mpd.activity_id')
                    ->join(DB::raw('sub_activities as sa'), 'sa.id', '=', 'mpd.sub_activity_id')
                    ->join(DB::raw('sub_threat_codes as stc'), 'stc.id', '=', 'od.sub_threat_codes_id')
                    ->join(DB::raw('threat_codes as tc'), 'tc.id', '=', 'stc.threat_codes_id')
                    ->join(DB::raw('observation_teams as ot'), 'ot.observation_id', '=', 'o.id')
                    ->join(DB::raw('users as user'), 'user.id', '=', 'ot.user_id')
                    ->groupBy([
                        'observation_no',
                        'observation_date',
                        'start_time',
                        'end_time',
                        'component_type',
                        'task_observed',
                        'maintenance_process',
                        'location',
                        'name',
                        'description',
                        'safety_risk',
                        'threat',
                        'sub_threat',
                        'effectively_managed',
                        'error_outcome',
                        'remark',
                    ])
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Observation Number',
            'Observation Date',
            'Start time',
            'End time',
            'A/C / Engine / Component Type',
            'Process/Task Being Observed',
            'Maintenance Process',
            'Observation Team',
            'Location',
            'Activity Category',
            'Sub Category',
            'Safety Risk',
            'Threat Code',
            'Sub Threat Code',
            'Threat Effectively managed? (Y/N)',
            'Error Outcome',
            'Remark'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
