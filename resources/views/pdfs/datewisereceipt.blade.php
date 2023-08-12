<!DOCTYPE html>
<html lang="en">
    @php
    $c = new App\Http\Controllers\Controller;
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STUDY CERTIFICATE</title>
    <style>
        body {
            border: 1px solid black;
        }

        .fb {
            font-weight: bold;
        }

        .bb {
            border-bottom: 1px solid black;
        }

        table {
            padding-top: 0.5;
            padding-bottom: 1rem;
            font-size: 18px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
        }
    </style>
</head>

<body>

    <table style="width: 100%;" class="bb fb">
        <tr>
            <td align="center" style="font-size: 14px;">
                <div style="margin-bottom: 0.5rem;">
                    NAVANAGAR ROTARY EDUCATION SOCIETY'S
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 18px;">
                NAVANAGAR ROTARY ENGLISH MEDIUM SCHOOL
            </td>
        </tr>
        <tr>
            <td align="center">
                NAVANAGAR, HUBBALLI-580025
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding: 0px" class="bb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                   {{$section == "" ? "" : $section." SCHOOL"}} DATEWISE RECEIPT DETAILS <span class="fb">({{$date}}{{isset($to_date) ? ' - '.$to_date : ""}})</span>
                </div>
            </td>
        </tr>
    </table>

    <table style="border: 1px solid black; width: 100%;" id="customers">
        <thead>
            <tr>
                <th>
                    SL No
                </th>
                <th>
                    Receipt No
                </th>
                <th>
                    A/C No
                </th>
                <th>
                    Student Name
                </th>
                <th>
                    Standard
                </th>
                <th>
                    Amount
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalExpected = 0;
                $totalCollected = 0;
            @endphp
            @forelse($fees as $fee)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{$fee->id}}
                    </td>
                    <td>
                        {{ $fee->student->id }}
                    </td>
                    <td style="width: 17rem;">
                        {{ strtoupper($fee->student->name) }}{{ $fee->student->fname == null ? '' : '. '.strtoupper($fee->student->fname)[0].' .'}}{{$fee->student->lname == null ? "" :strtoupper($fee->student->lname)}}
                    </td>
                    <td>
                        {{ $fee->class }}
                    </td>
                    <td>
                        {{ $fee->amt_paid }} @php $totalExpected = $totalExpected + $fee->amt_paid @endphp
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        No Data Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="fb" style="border: 2px solid black; width: 70%; margin-left: 5rem; padding-left: 0.4rem; padding-right: 0.4rem;padding-top: 0.4rem;">
        <tr>
            <td align="left" style="width: 70%;">
                <span class="fb"> AMOUNT EXPECTED </span>
            </td>

            <td class="fb">:</td>

            <td align="right" style="width: 100%;">
              {{$totalExpected}}
            </td>
        </tr>
        <tr >
            <td align="left" style="width: 100% ; padding-top: 1rem; padding-bottom: 1rem">
                <span class="fb"> AMOUNT COLLECTED  </span>
            </td>

            <td class="fb" style="padding-top: 1rem; padding-bottom: 1rem">:</td>

            <td align="right" style="width: 100%; padding-top: 1rem; padding-bottom: 1rem">
                {{$totalCollected}}
            </td>
        </tr>
        <tr>
            <td align="left" style="width: 75%;">
                <span class="fb"> BALANCE  </span>
            </td>

            <td class="fb">:</td>

            <td align="right" style="width: 100%;">
                {{$totalExpected - $totalCollected}}
            </td>
        </tr>
    </table>



</body>

</html>
