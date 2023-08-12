<!DOCTYPE html>
<html lang="en">
    @php
    $c = new App\Http\Controllers\Controller;
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deuplicate Receipt</title>
    <style>
        #table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        th {
            border: 1px solid #C8C6C6;
            text-align: left;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #EBEBEB96;
        }

        footer {
            position: fixed;
            bottom: 5rem;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 14px !important;
        }
    </style>
</head>

<body>
    <table style="width: 100%; border-bottom: 1px solid black">
        <tr>
            <td>
                <b>Receipt Date:</b> {{ $receipt->created_at->format('d-m-Y') }}
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <b>Student Name : </b> {{ ucwords($student->name) }}
                {{ $student->fname == null ? '' : ucwords($student->fname)[0] . ' . ' }}
                {{ $student->lname == null ? '' : ucwords($student->lname) }}
            </td>
            <td><b>Academic Year : </b> {{$receipt->year}} </td>
        </tr>
        <tr>
            <td>
                <b>Registered No : </b> {{ $student->id }}
            </td>
            <td>
                <b>Standard : </b> {{ $receipt->class }}
            </td>
        </tr>
    </table>

    <table style="width: 100%;" id="table">
        @foreach ($fees as $fee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $fee->fee_head }}</td>
                <td align="right">{{ $fee->amount }}</td>
            </tr>
        @endforeach
    </table>

    <table style="width: 100%;">
        <tr>
            <td>
                <b>Annual Fees</b> =  Tuition Fees <b>x</b> 12 Months <b>+</b> Other Fees
            </td>
        </tr>
    </table>

    <table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; margin-top: 1rem;">
        <td>
            <div><b>Annual Fee</b></div>
            <div>{{ $c->moneyFormatIndia($tpb->total) }}.00</div>
        </td>
        <td>
            <div><b>Fees Paid</b></div>
            <div>{{ $c->moneyFormatIndia($tpb->paid) }}.00</div>
        </td>
        <td>
            <div><b>Balance</b></div>
            <div>{{ $c->moneyFormatIndia($tpb->balance) }}.00</div>
        </td>
        <td style="border-left: 1px solid black" align="right">
            <div><b>Receipt Amount</b></div>
            <div>{{ $c->moneyFormatIndia($receipt->amt_paid) }}.00</div>
        </td>
    </table>

    <table style="margin-top: 1rem;">
        <tr>
            <td>
                <b>Amount in words :</b> {{strtoupper($c->getWord($receipt->amt_paid))}}
            </td>
        </tr>
    </table>

    <footer>
        <table style="width: 100%; margin-top: 1rem;">
            <tr>
                <td align="right">
                    Authorised Signatory
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
