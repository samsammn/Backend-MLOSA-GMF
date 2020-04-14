<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Observation</title>
    <style>
        @page {
            margin: 40px 40px 80px 40px;
        }

        /* header {
            position: fixed;
            top: -50px;
            left: 0px;
            right: 0px;
            height: 150px;
        } */

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .table td {
            vertical-align: top;
            padding: 5px;
            font-size: 13px;
            border: 1px solid #000;
            border-right: 0px;
        }
        .table th {
            background: #ddd;
            padding: 10px 3px;
            font-size: 13px;
        }
        small {
            font-weight: normal;
            font-style: italic;
        }
        .table td p {
            margin: 0px;
            /* height: 190px; */
            padding: 0.3rem 1rem;
        }
        .table-merge {
            width: 100%;
            border-collapse: collapse;
            border: 0px;
        }
        .table-merge .table td{
            padding: 5px;
            border: 1px solid #000;
        }
        .table-merge td:first-child .table td {
            border-right: 0px;
        }
        .title {
            border-bottom: 2px solid #555;
            text-align: right;
            padding-right: 2.5rem;
            padding-bottom: 0.6rem;
        }
        h3 {
            text-align: center;
        }
        .table .no-border {
            padding: 0px;
            width: 2px;
            border-right: 1px solid transparent !important;
            border-left: 1px solid transparent !important;
        }
        .page-end:before {
            content: counter(page);
        }
    </style>
</head>
<body>
    <header>
        <table width="100%">
            <tr>
                <td width="25%"><img src="{{ public_path() . '/images/logo.png' }}" width="250px"></td>
                {{-- <td width="25%"><img src="{{ URL::asset('/images/logo.png') }}" width="280px"></td> --}}
                <td>
                    <h2 class="title">
                        M LOSA FORM -{{ $data['maintenance_process']->sequence }} ({{ $data['maintenance_process']->name }})
                    </h2>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <span class="page_end">
            Form GMF/ {{ $data['maintenance_process']->number }}
        </span>
    </footer>

    <main>
        <table border="1" class="table" style="margin-top: 1.5rem">
            <thead>
                <tr>
                <td width="180px">
                    Observation Number
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ $data['observation']->no }}
                </td>
                <td rowspan="5">
                    Observation Team :
                    <ol>
                        @foreach ($data['observation']->team as $item)
                            <li>{{ $item->fullname }}</li>
                        @endforeach
                    </ol>
                </td>
                </tr>
                <tr>
                <td>
                    Observation Date
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ date('d M Y', strtotime($data['observation']->date)) }}
                </td>
                </tr>
                <tr>
                <td>
                    Observation Start Time
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ $data['observation']->start_time }}
                </td>
                </tr>
                <tr>
                <td>
                    Observation End Time
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ $data['observation']->end_time }}
                </td>
                </tr>
                <tr>
                <td>
                    A/C/Engine/Component
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ $data['observation']->component_type }}
                </td>
                </tr>
                <tr>
                <td>
                    Process/Task Being Observation
                </td>
                <td class="no-border">:</td>
                <td>
                    {{ $data['observation']->task_observed }}
                </td>
                <td>
                    Location/Station :
                    {{ $data['observation']->location }}
                </td>
                </tr>
            </thead>
        </table>

        <h3>Hazard (Threat) Codes</h3>
        <table class="table-merge">
            <thead>
            <tr>
                <td width="50%">
                    <table class="table">
                    <thead>
                    @foreach ($data['threat_codes']['left'] as $item)
                        <tr>
                            <td>{{ $item->code . '. ' . $item->description }}</td>
                        </tr>
                    @endforeach
                    </thead>
                    </table>
                </td>
                <td width="50%">
                    <table class="table">
                    <thead>
                    @foreach ($data['threat_codes']['right'] as $item)
                        <tr>
                            <td>{{ $item->code . '. ' . $item->description }}</td>
                        </tr>
                    @endforeach
                    </thead>
                    </table>
                </td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <table class="table" border="1" style="margin-top: 3rem">
            <tr>
                <th width="5%">No</th>
                <th>Activity</th>
                <th width="90px">
                    Safety Risk <br>
                    <small>
                        N/A, <br>
                        Safe (S), <br>
                        At Risk (AR), <br>
                        Didn't Observe (DNO) <br>
                    </small>
                </th>
                <th width="80px">
                    Hazard (Threat) Code <br>
                    <small>
                        See Hazard (Threat) Code List
                    </small>
                </th>
                <th width="70px">
                    Hazard (Threat) Effectively Managed <br>
                    <small>
                        Y/N
                    </small>
                </th>
                <th width="100px">
                    Error Outcome <br>
                    <small>
                        1. Inconsequential<br>
                        2. Undesired state<br>
                        3. Additional error<br>
                    </small>
                    & Remarks
                </th>
            </tr>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data['activities'] as $activity)
                    <tr style="background: #eee;">
                        <td></td>
                        <td colspan="5">{{ $activity->name }}</td>
                    </tr>
                    @foreach ($activity->sub_activities as $sub)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $sub->description }}</td>
                            <td>{{ $sub->inputs->safety_risk }}</td>
                            <td>{{ $sub->inputs->threat_codes }}</td>
                            <td>{{ $sub->inputs->effectively_managed }}</td>
                            <td>{{ $sub->inputs->error_outcome }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <table class="table" border="1" style="margin-top: 2rem">
            <tr>
                <td>
                    <label>Describe the hazard/threat(s). How did the crew manage or mismanage the hazard/threat(s)?</label>
                    <p>- {{ $data['observation']->describe_threat }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Describe the crew error(s) and associated undesired state</label>
                    <p>- {{ $data['observation']->describe_crew_error }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Comments - Good or bad (Please provide examples)</label>
                    <p>- {{ $data['observation']->comment }}</p>
                </td>
            </tr>
        </table>
    </main>

</body>
</html>
