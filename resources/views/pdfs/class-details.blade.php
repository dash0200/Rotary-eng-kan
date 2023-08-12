<!DOCTYPE html>
<html lang="en">
    @php
    $controller = new App\Http\Controllers\Controller;
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CLASS DETAILS</title>
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

    <table style="width: 100%; padding: 0px" class="bb fb">
        <tr>
            <td align="center">
                Academic Year: {{$year}}
            </td>
            <td align="center">
                Standard:{{$class}}
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
                <th>
                    Student / Father / Surname
                </th>
                <th>D.O.B</th>
                <th>CASTE</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $d)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$d->id}}</td>
                    <td>
                        <div>
                            {{strtoupper($d->name)}}
                        </div>
                        <div>
                            {{strtoupper($d->fname)}}
                        </div>
                        <div>
                            {{strtoupper($d->lname)}}
                        </div>
                    </td>
                    <td>{{$d->dob->format("d-m-Y")}}</td>
                    <td>{{$d->caste}}</td>
                </tr>
            @empty
                <tr>
                    <td align="center" colspan="5">
                        No Data found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
