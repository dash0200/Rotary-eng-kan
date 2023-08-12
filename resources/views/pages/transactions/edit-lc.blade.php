<x-main-card>
<div class="flex flex-col space-y-4">

<div class='flex justify-between'>
    <p>LC Number : <b>{{$lc->id}}</b></p>
    <p>Student Register Number : <b>{{$lc->student}}</b></p>
</div>
        <div class="flex space-x-2 mt-5 items-center justify-around">
            <div>
                <x-label value="Studied Till Class" />
                <select name="class" id="class" required>
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" @if($lc->studied_till == $class->id ) selected @endif>{{ $class->name }}</option>
                    @endforeach
                </select>
                <span id="tillClassError" class="text-red-500"></span>
            </div>
            <div>
                <x-label value="Till Academic Year" />
                <select name="year" id="year" required>
                    <option value="">Select Year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}" @if($lc->till_aca_year == $year->id ) selected @endif>{{ $year->year }}</option>
                    @endforeach
                </select>
                <span id="tillYearError" class="text-red-500"></span>
            </div>
        </div>

        <div class="flex justify-between mt-5 space-x-2">
            <div class="w-full">
                <x-label value="WAS STUDYING WHILE LEAVING" />
                <x-input name="wasStd" value="{{$lc->was_studying}}" placeholder="WAS STUDYING WHILE LEAVING" />
            </div>
            <div class="w-full">
                <x-label value="WHETHER QUALIFIED FOR PROMOTION" />
                <x-input name="qualif" value="{{$lc->whether_qualified}}" placeholder="WHETHER QUALIFIED FOR PROMOTION" />
            </div>
        </div>
        
        <div class="flex justify-between mt-5 space-x-2">
            <div class="w-full">
                <x-label value="LAST ATTENDANCE" />
                <x-input type="date" value="{{$lc->lt}}" name="la" />
                <span id="laError"  class="text-red-500"></span>
            </div>
            <div class="w-full">
                <x-label value="DATE OF APPLICATION" />
                <x-input type="date" name="dop" value="{{$lc->doa}}" />
            </div>
            <div class="w-full">
                <x-label value="DATE OF ISSUING L.C" />
                <x-input type="date" name="doi" value="{{$lc->doil}}" />
            </div>
            <div class="w-full">
                <x-label value="REASON for Leaving the School" />
                <x-input type="text" name="reason" value="{{$lc->reason}}"  />
            </div>
        </div>

        <div class="flex mt-5 justify-center" id="save">
            <x-button-primary class="w-1/4" value="SUBMIT" onclick="updateLc()" />
        </div>
    </div>
</x-main-card>

<script>
    $("#class").select2()
    $("#year").select2()


    function updateLc(){
        $.ajax({
            type: "post",
            url: "{{route('trans.updateLc')}}",
            data: {
                id:{{$lc->id}},
                stdTill: $("#class").val(),
                tillYear: $("#year").val(),
                wasStd: $("input[name='wasStd']").val(),
                qualified: $("input[name='qualif']").val(),
                la: $("input[name='la']").val(),
                doa: $("input[name='doa']").val(),
                doi: $("input[name='doi']").val(),
                reason: $("input[name='reason']").val(),
            },
            dataType: "json",
            beforeSend: function(){
                $("#save").html('')
                $("#save").append(
                    `
                    <x-loading-button />
                    `
                );
            },
            success: function (res) {
                console.log(res)
                
                window.open(`/transaction/print-lc?id=${res.lc}`, '_blank');

                window.location.href = "{{route('trans.searchLC')}}"
            }
        });
    }
</script>