<x-main-card>
    Fees Register
    <div class="w-full bg-gray-200" style="height: 1px;"></div>


    <form method="post" action="{{route('fees.pdfFeesRegister')}}">
        @csrf
    <div class="flex justify-around">
        <div class="m-2">
            <x-label value="Academic Year" />
            <select name="year" id="year" required>
                <option value="">Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>

        <div class="m-2">
            <x-label value="Class" />
            <select name="class" id="class" required>
                <option value="">Select Year</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                @endforeach
            </select>
        </div>

        <x-button-primary value="SUBMIT" />
    </div>
    </form>
</x-main-card>
<script>
    $("#year").select2()
    $("#class").select2()
</script>