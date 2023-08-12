<!DOCTYPE html>
<html lang="en">
    @php
    $controller = new App\Http\Controllers\Controller;
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

    <table style="width: 100%; padding: 0px" class="bb fb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                    FEES REGISTER
                </div>
            </td>
        </tr>
    </table>


    <table style="border: 1px solid black; width: 100%;" id="customers">
        <thead style="font-size: 14px;">
            <tr>
                <th>
                    SL No
                </th>
                <th>
                    A/C No
                </th>
                <th style="width: 15rem;">
                    Student Name
                </th>
                <th>
                   Receipt No
                </th>
                <th>
                    Receipt Date
                </th>
                <th>
                    Amount
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($fees as $fee)
                <tr>
                    <td align="center">
                        {{$loop->iteration }}
                    </td>
                    <td align="center">
                        {{$fee->student->id}}
                    </td>
                    <td align="left">
                        {{strtoupper($fee->student->name)}}  {{$fee->student->fname == null ? '' : '.'.strtoupper($fee->student->fname)[0].'.'}}  {{$fee->student->lname==null ? '':strtoupper($fee->student->lname)}}
                    </td>
                    <td align="right">
                        {{$fee->id}}
                    </td>
                    <td align="right">
                        {{$fee->created_at->format("d-m-Y")}}
                    </td>
                    <td>
                        {{$controller->moneyFormatIndia($fee->amt_paid)}}.00    </td>
                    </td>
                </tr>
                <tr style="font-weight: bold;">

                    <td colspan="3" align="right" style="font-weight: normal;">{{$fee->type}}</td>
                    <td colspan="1" align="right"> {{$controller->moneyFormatIndia($amount)}}.00 </td>
                    <td align="right"> {{$controller->moneyFormatIndia($fee->amt_paid) }}.00</td>
                    <td> {{$controller->moneyFormatIndia($amount - $fee->amt_paid)}}.00 </td>
                </tr>
            @empty
                <tr>
                    <td align="center" colspan="6">
                        No Data Found
                    </td>
                </tr>
           @endforelse
        </tbody>
    </table>

</body>

</html>
