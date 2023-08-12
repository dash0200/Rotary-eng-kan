
<x-main-card>
    BONAFIED CERTIFICATE
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <div class="flex justify-between items-center">
      <div class="flex">
          <div class="m-2">
              <x-label value="From Class" />
              <select name="class" id="class" required
                  class="{{ $errors->has('class') ? 'is-invalid' : '' }}">
                  <option value="">Select Class</option>
                  @foreach ($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
              </select>
          </div>
      </div>

      <div class="flex">
        <div class="m-2">
            <x-label value="From Year" />
            <select name="ac_year" id="year" class="w-full" required>
                <option value="">Academic Year</option>
                @foreach ($years as $year)
                    <option value="{{$year->id}}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
    </div>

      <div id="pdf">
        @if($print == true)
            <a href="{{route('certificate.pdfBonafied', ['id' => $student->id])}}" target="_blank">
                <x-button-success value="GET PDF" />
            </a>
        @else
            Save below information to Get PDF
        @endif
      </div>

    </div>
    <div class="w-full bg-gray-200" style="height: 1px;"></div>


    <div class="mt-10 w-full space-y-4">
       <div class="flex items-center">
            <div class="mr-4"> Kumar / Kumari.</div> <div><x-input type="text" disabled value="{{strtoupper($student->name)}}.{{strtoupper($student->fname)}}.{{strtoupper($student->lname)}}"/></div>
            <div class="mr-4 ml-4"> Son / Daughter of</div> <div><x-input type="text" disabled value="{{strtoupper($student->fname)}}.{{strtoupper($student->lname)}}"/></div> <div class="ml-2">is a student of our school.</div>
       </div>

       <div class="flex items-center">
            <div class="mr-4"> He / She Studying in </div> <div><x-input disabled type="text" id="std" value="{{$standard}}"/></div>
            <div class="ml-2 mr-2">Standard. During the academic year </div> <div><x-input type="text" disabled id="yr" value="{{$acaYear}}"/></div>
       </div>

       <div class="flex items-center">
            <div class="mr-4">and His/Her Register Number is</div> <div><x-input disabled type="text" value="{{$student->id}}"/></div>
       </div>

      <div class="flex justify-center w-full" id="save">
        <x-button-primary value="SAVE" onclick="saveStd('{{$student->id}}')" />
      </div>
    </div>

    <div  class="mt-11">
        As per record

        Studying in : <b>{{$Rstandard}}</b> for the Academic year : <b>{{$RacaYear}}</b>
    </div>

</x-main-card>

<script>
    $("#class").select2();
    $("#year").select2();

    $("#class").on("select2:select", function(e){
        $("#std").val(e.params.data.text);
    });

    $("#year").on("select2:select", function(e){
        $("#yr").val(e.params.data.text);
    });

    function saveStd(id){
        
        $.ajax({
            type: "post",
            url: "{{route('certificate.saveBonafied')}}",
            data: {
                id: id,
                std: $("#std").val(),
                year: $("#yr").val(),

            },
            beforeSend: function(data) {
                $("#save").html("");
                $("#save").append(
                    `
                    <x-loading-button value="saving" />
                    `
                );
            },
            dataType: "json",
            success: function (res) {
                $("#save").html("");
                $("#save").append(
                    `
                    <x-button-primary value="SAVE" onclick="saveStd('{{$student->id}}')" />
                    `
                );
                location.reload();
            }
        });
    }
</script>