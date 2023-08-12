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

    <table style="width: 100%; padding: 0px" class="bb fb">
        <tr>
            <td align="center">
                <div style="font-size: 20px; padding: 0.3rem;">
                    {{$section}} - DAY BOOK - FEES COLLECTED ON : {{$date}}
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
                    Receipt No
                </th>
                <th>
                    ID No
                </th>
                <th style="width: 15rem;">
                    Student Name
                </th>
                <th>
                   Class
                </th>
                <th>
                    Amount
                </th>
                {{-- <th>
                    Active
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @forelse($receipts as $receipt)
                <tr>
                    <td align="center">
                        {{$loop->iteration }}
                    </td>
                    <td align="center">
                        {{$receipt->id}}
                    </td>
                    <td align="center">
                        {{$receipt->student->id}}
                    </td>
                    <td align="left">
                        {{strtoupper($receipt->student->name)}}  {{ $receipt->student->fname == null ? '' : '.'.strtoupper($receipt->student->fname)[0].'. '}} 
                        {{$receipt->student->lname == null ? "" :strtoupper($receipt->student->lname)}}
                    </td>
                    <td align="right">
                        {{$receipt->class}}
                    </td>
                    <td align="right">
                        {{ $c->moneyFormatIndia($receipt->amt_paid) }}.00 @php $total = $total + $receipt->amt_paid; @endphp
                    </td>
                    {{-- <td>
                        YES
                    </td> --}}
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
            <td align="left" style="width: 100%;">
                <span class="fb">TOTAL FEES COLLECTED </span>
            </td>

            <td class="fb">:</td>

            <td align="right" style="width: 100%;">
              {{ $c->moneyFormatIndia($total) }}.00
            </td>
        </tr>
    </table>



</body>

</html>
