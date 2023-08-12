@livewire('navigation-menu')
    <head>
        <style>
            table {
            padding-top: 0.5;
            padding-bottom: 1rem;
            font-size: 14px;
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

         /* Chrome, Safari, Edge, Opera */
         input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] { --moz-appearance: textfield; }

        </style>

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />

    <link rel="icon" href="{{asset('logo.png')}}">
    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/ubuntu.css')}}"> --}}


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    </head>

<div>
    <form action="{{route('report.feesStructure')}}" method="get">
        <select name="year" id="years">
            <option value="">Select Year</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}"> {{$year->year}} </option>
            @endforeach
        </select>

        <x-button-primary value="GET" />
    </form>
</div>
<div class="w-full">
    {{$yr}}
</div>
<div>
    <table id="customers">
        
        <tr>
            <th></th>
            @foreach($heads as $head)
            <th>
                {{$head->desc}} 
            </th>
            @endforeach
            <th>
                Annual Fees
            </th>
        </tr>

        <tr>
            <th>NURSERY</th>
            @if(count($nursery) > 1)
            @foreach($nursery as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$nursery[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>LKG</th>
            @if(count($lkg) > 1)
            @foreach($lkg as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$lkg[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>UKG</th>
            @if(count($ukg) > 1)
            @foreach($ukg as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$ukg[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>1ST</th>
            @if(count($first) > 1)
            @foreach($first as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$first[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>2ND</th>
            @if(count($second) > 1)
            @foreach($second as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$second[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>3RD</th>
            @if(count($third) > 1)
            @foreach($third as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$third[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>4TH</th>
            @if(count($fourth) > 1)
            @foreach($fourth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$fourth[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>5TH</th>
            @if(count($fifth) > 1)
            @foreach($fifth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$fifth[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>6TH</th>
            @if(count($sixth) > 1)
            @foreach($sixth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$sixth[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>7TH</th>
            @if(count($seventh) > 1)
            @foreach($seventh as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$seventh[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>8TH</th>
            @if(count($eighth) > 1)
            @foreach($eighth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$eighth[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>9TH</th>
            @if(count($ninth) > 1)
            @foreach($ninth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$ninth[0]->amt_per_annum }}</td>
            @endif
        </tr>
        <tr>
            
            <th>10TH</th>
            @if(count($tenth) > 1)
            @foreach($tenth as $n)
                <td>{{$n->amount}}</td>
            @endforeach
            <td>{{$tenth[0]->amt_per_annum }}</td>
            @endif
        </tr>
    </table>
</div>

<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flowbite.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>

<script>
    $("#years").select2()
</script>
