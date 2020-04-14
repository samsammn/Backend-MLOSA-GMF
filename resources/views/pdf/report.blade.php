<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        @page {
            margin: 40px 40px 80px 40px;
        }
        body {
            font-family: calibri;
            color: #333;
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
            border: 1px solid #333;
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
            border: 1px solid #333;
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
        .body-report {
            /* border: 1px solid #333; */
            border-top: 0px;
            padding: 10px;
        }
        .content-title {
            font-weight: bold;
            margin: 0px;
            /* font-size: 16px; */
            color: #333;
            /* line-height: 12px; */
        }
        .content li {
            text-align: justify;
            color: #333;
            padding-bottom: 7px;
            padding-right: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div align="center">
            <img src="{{ public_path() . '/images/logo.png' }}" width="210px">
            <h2>QUALITY ASSURANCE & SAFETY REPORT</h2>
        </div>
    </header>

    <footer>
        <span class="page_end">
            Form GMF-Q 211 R1
        </span>
    </footer>

    <main>
        <table border="1" class="table">
            <tbody>
                <tr>
                    <td rowspan="7" width="72%">
                        Title: Test MLOSA<br>
                        Subject: Summary MLOSA Report 2020
                    </td>
                    <td width="100px">
                        No
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Date
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Attention
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Issued
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Prepared By
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Checked By
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Approved By
                    </td>
                    <td class="no-border">:</td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Distribution:
                        DT, DB, DL, MQ, MC, TB
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="body-report">
            <ol class="content" type="I">
                <li>
                    <p class="content-title">INTRODUCTION</p>
                    <div class="content-desc">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Sed fortuna fortis; Tum Torquatus: Prorsus, inquit, assentior; </p>
                        <p>Pugnant Stoici cum Peripateticis. Equidem e Cn. Aliena dixit in physicis nec ea ipsa, quae tibi probarentur; Quid ad utilitatem tantae pecuniae? Quid sequatur, quid repugnet, vident. </p>
                        <p>Sed potestne rerum maior esse dissensio? Quod cum dixissent, ille contra. Duo Reges: constructio interrete. Teneo, inquit, finem illi videri nihil dolere. Vestri haec verecundius, illi fortasse constantius. </p>
                        <p>Prave, nequiter, turpiter cenabat; Equidem, sed audistine modo de Carneade? Hoc simile tandem est? At coluit ipse amicitias. Iam in altera philosophiae parte. Zenonis est, inquam, hoc Stoici. </p>
                    </div>
                </li>
                <li>
                    <p class="content-title">BRIEF SUMMARY</p>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Sed fortuna fortis; Tum Torquatus: Prorsus, inquit, assentior; </p>
                        <p>Pugnant Stoici cum Peripateticis. Equidem e Cn. Aliena dixit in physicis nec ea ipsa, quae tibi probarentur; Quid ad utilitatem tantae pecuniae? Quid sequatur, quid repugnet, vident. </p>
                        <p>Sed potestne rerum maior esse dissensio? Quod cum dixissent, ille contra. Duo Reges: constructio interrete. Teneo, inquit, finem illi videri nihil dolere. Vestri haec verecundius, illi fortasse constantius. </p>
                        <p>Prave, nequiter, turpiter cenabat; Equidem, sed audistine modo de Carneade? Hoc simile tandem est? At coluit ipse amicitias. Iam in altera philosophiae parte. Zenonis est, inquam, hoc Stoici. </p>
                    </div>
                </li>
                <li>
                    <p class="content-title">SECTION SUMMARIES</p>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Sed fortuna fortis; Tum Torquatus: Prorsus, inquit, assentior; </p>
                        <p>Pugnant Stoici cum Peripateticis. Equidem e Cn. Aliena dixit in physicis nec ea ipsa, quae tibi probarentur; Quid ad utilitatem tantae pecuniae? Quid sequatur, quid repugnet, vident. </p>
                        <p>Sed potestne rerum maior esse dissensio? Quod cum dixissent, ille contra. Duo Reges: constructio interrete. Teneo, inquit, finem illi videri nihil dolere. Vestri haec verecundius, illi fortasse constantius. </p>
                        <p>Prave, nequiter, turpiter cenabat; Equidem, sed audistine modo de Carneade? Hoc simile tandem est? At coluit ipse amicitias. Iam in altera philosophiae parte. Zenonis est, inquam, hoc Stoici. </p>
                    </div>
                </li>
                <li>
                    <p class="content-title">RECOMMENDATION</p>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Sed fortuna fortis; Tum Torquatus: Prorsus, inquit, assentior; </p>
                        <p>Pugnant Stoici cum Peripateticis. Equidem e Cn. Aliena dixit in physicis nec ea ipsa, quae tibi probarentur; Quid ad utilitatem tantae pecuniae? Quid sequatur, quid repugnet, vident. </p>
                        <p>Sed potestne rerum maior esse dissensio? Quod cum dixissent, ille contra. Duo Reges: constructio interrete. Teneo, inquit, finem illi videri nihil dolere. Vestri haec verecundius, illi fortasse constantius. </p>
                        <p>Prave, nequiter, turpiter cenabat; Equidem, sed audistine modo de Carneade? Hoc simile tandem est? At coluit ipse amicitias. Iam in altera philosophiae parte. Zenonis est, inquam, hoc Stoici. </p>
                    </div>
                </li>
            </ol>
        </div>
    </main>

</body>
</html>
