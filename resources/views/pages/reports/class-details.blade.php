<x-main-card>
    Class Details
    <form action="{{route("report.detailsClass")}}" method="post">
        @csrf
<div class="flex justify-around">
        <div class="m-2 w-full">
            <x-label value="Classes" />
            <select name="class" id="class" required
                class="{{ $errors->has('class') ? 'is-invalid' : '' }} w-full">
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="m-2 w-full">
            <x-label value="Year" />
            <select name="year" id="year" class="w-full" required>
                <option value="">Academic Year</option>
                @foreach ($years as $year)
                    <option value="{{$year->id}}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="m-2 w-full">
            <x-label value="Selection Criteria" />
            <select name="critic" id="critic" class="w-full" required>
                <option value="">Select Criteria</option>
                <option value="IN">IN</option>
                <option value="OUT">OUT</option>
                <option value="BOTH" selected>BOTH</option>
            </select>
        </div>

        <div>
            <x-button-primary value="SUBMIT" />
        </div>
</div>
</form>
</x-main-card>

<script>
    $("#class").select2()

    $("#year").select2()

    $("#critic").select2()
</script>