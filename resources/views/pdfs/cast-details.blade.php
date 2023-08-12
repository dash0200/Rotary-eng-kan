<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cast Details</title>
    <style>
        body{
            border: 1px solid black;
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
    
    <table style="width: 100%; font-weight: bold; border-bottom: 1px solid black">
        <tr>
            <td align="center">
                NAVANAGAR ROTARY EDUCATION SOCIETY
            </td>
        </tr>
        <tr>
            <td align="center">
                NAVANAGAR ROTARY ENGLISH & KANNADA MEDIUM SCHOOL
            </td>
        </tr>
    </table>
    <table style="width: 100%; font-weight: bold; border-bottom: 1px solid black">
        <tr>
            <td align="center">
                CATEGORYWISE CASTE DETAILS
            </td>
        </tr>
        <tr>
            <td align="center">
                CATEGORY: {{$cat}}
            </td>
        </tr>
    </table>
    
    <div>
        <table style="float: left; width: 50%; font-weight: bold; border-bottom: 1px solid black" id="customers">
            <thead>
                <tr>
                    <th>
                        SL NO
                    </th>
                    <th>
                        CASTE NAME
                    </th>
                </tr>
            </thead>
           <tbody>
            @forelse($casts as $cast)
                @if($loop->iteration % 2 !== 0)
                <tr>
                    <td align="center">
                        {{$loop->iteration}}
                    </td>
                    <td align="center">
                        {{$cast->name}}
                    </td>
                </tr>
                @endif
            @empty
            @endforelse 
           </tbody>
        </table>
        
        <table style="float: left; width: 50%; font-weight: bold; border-bottom: 1px solid black" id="customers">
            <thead>
                <tr>
                    <th>
                        SL NO
                    </th>
                    <th>
                        CASTE NAME
                    </th>
                </tr>
            </thead>
           <tbody>
            @forelse($casts as $cast)
                @if($loop->iteration % 2 == 0)
                <tr>
                    <td align="center">
                        {{$loop->iteration}}
                    </td>
                    <td align="center">
                        {{$cast->name}}
                    </td>
                </tr>
                @endif
            @empty
            @endforelse 
           </tbody>
        </table>
    </div>

</body>
</html>