<!DOCTYPE html>
<html lang="en">
    @php
    $c = new App\Http\Controllers\Controller;
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>General Receipt</title>
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
            font-size: 16px;
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
            <td align="right" class="fb">
                <div style="font-size: 20px; padding: 0.3rem;">
                    GENERAL RECEIPT DAY BOOK
                </div>
            </td>

            <td align="right">
                @if(isset($from))
                {{date('d-m-Y',strtotime($from))}} - {{date('d-m-Y',strtotime($to))}}
                @else
                {{date('d-m-Y',strtotime($receipts[0]->date))}}
                @endif
               
            </td>
        </tr>
    </table>


    <table style="width: 100%; padding: 0px" class="bb fb" id="customers">
        <thead>
            <tr>
                <th>SL No</th>
                @if(isset($from))
                    <th>Date</th>
                @endif
                <th>Receipt No</th>
                <th>Towards/Particulars</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($receipts as $r)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    @if(isset($from))
                    <td>{{date('d-m-Y',strtotime($r->date))}}</td>
                    @endif
                    <td>{{$r->id}}</td>
                    <td>{{$r->cause}}</td>
                    <td>{{$r->amount}}</td> @php $total += $r->amount; @endphp
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 50%; margin-top: 2rem; margin-left: 11rem; padding: 2rem; border: 1px solid black;">
        <tr>
            <td>
                Total Amount Collected : 
            </td>

            <td>
                Rs. <b> {{$c->moneyFormatIndia($total)}}</b>
            </td>
        </tr>
    </table>

</body>

</html>
