<script type="text/javascript" src="{{ asset('js/transliteration-input.bundle.js') }}"></script>

<x-main-card>
    STUDY CERTIFICATE
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <div class="flex justify-between items-center">
      <div class="flex">
          <div class="m-2">
              <x-label value="From Class" />
              <select name="class" id="class_from" required
                  class="{{ $errors->has('class') ? 'is-invalid' : '' }}">
                  <option value="">Select Class</option>
                  @foreach ($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="m-2">
              <x-label value="To Class" />
              <select name="class" id="class_to" required
                  class="{{ $errors->has('class') ? 'is-invalid' : '' }}">
                  <option value="">Select Class</option>
                  @foreach ($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
              </select>
          </div>
      </div>

      <div id="pdf">
        @if($print == true)
            <a href="{{route('certificate.studyPDF', ['id' => $student->id])}}" target="_blank">
                <x-button-success value="GET PDF with COUNTER SIGN" />
            </a>
            <a href="{{route('certificate.studyPDF2', ['id' => $student->id])}}" target="_blank">
                <x-button-success value="GET PDF 2" />
            </a>
        @else
            Save below information to Get PDF
        @endif
      </div>

    </div>
    <div class="w-full bg-gray-200" style="height: 1px;"></div>
    <div class="flex">
        <div class="m-2">
            <x-label value="From Year" />
            <select name="ac_year" id="from_year" class="w-full" required>
                <option value="">Academic Year</option>
                @foreach ($years as $year)
                    <option value="{{$year->id}}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <div class="m-2">
            <x-label value="To Year" />
            <select name="ac_year" id="to_year" class="w-full" required>
                <option value="">Academic Year</option>
                @foreach ($years as $year)
                    <option value="{{$year->id}}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-10 w-full space-y-4">
       <div class="flex items-center">
            <div class="mr-4"> Kumar / Kumari.</div> <div><x-input type="text" disabled value="{{strtoupper($student->name)}}.{{strtoupper($student->fname)}}.{{strtoupper($student->lname)}}"/></div>
            <div class="mr-4 ml-4"> Son / Daughter of</div> <div><x-input type="text" disabled value="{{strtoupper($student->fname)}}.{{strtoupper($student->lname)}}"/></div> <div class="ml-2">is a student of our school.</div>
       </div>

       <div class="flex items-center">
            <div class="mr-4"> He / She Studied from</div> <div><x-input disabled type="text" id="std_from" value="{{$std_from}}"/></div>
            <div class="mr-4 ml-4"> to </div> <div><x-input type="text" disabled id="std_to" value="{{$std_to}}"/></div> <div class="ml-2">standard in our instituition.</div>
       </div>

       <div class="flex items-center">
            <div class="mr-4"> During academic year from</div> <div><x-input type="text" disabled id="from_yr" value="{{$from_year}}"/></div>
            <div class="mr-4 ml-4"> to </div> <div><x-input type="text" disabled id="to_yr" value="{{$to_year}}"/></div> <div class="ml-2">.</div>
       </div>

       <div class="flex items-center">
            <div class="mr-4"> His/Her Register Number is</div> <div><x-input disabled type="text" value="{{$student->id}}"/></div>
            <div class="mr-4 ml-4"> and He/She belongs to caste </div> 
       </div>

       <div class="flex items-center">
            <x-table>
                <tbody>
                    <tr>
                        <x-td>
                            Caste
                        </x-td>
                        <x-td>
                            :
                        </x-td>
                        <x-td>
                            <input type="text" value="{{$caste}}" id="cast">
                        </x-td>
                        
                    </tr>
                    <tr>
                        <x-td>
                            Sub-Caste
                        </x-td>
                        <x-td>
                            :
                        </x-td>
                        <x-td>
                            <input type="text" value="{{$subCaste}}" id="subcast">
                        </x-td>
                        
                    </tr>
                    <tr>
                        <x-td>
                            Religion
                        </x-td>
                        <x-td>
                            :
                        </x-td>
                        <x-td>
                            <input type="text" value="{{$student->religion}}" id="religion">
                        </x-td>
                    </tr>
                </tbody>
            </x-table>
       </div>

       <div class="flex items-center">
        <div class="mr-4"> and mother tounge of the candidate is </div> <div><x-input type="text" value="ಕನ್ನಡ" name="mt" id="mt" placeholder="Mother Tounge"/></div>
        <span id="mtError" class="text-red-500"></span>
        <div class="mr-4 ml-4"> </div> 
       </div>

      <div class="flex justify-center w-full" id="save">
        <x-button-primary value="SAVE" onclick="saveStd('{{$student->id}}')" />
      </div>
    </div>

    <div class="mt-11">
        Details as per Record

        <div>
            Studied from standard : <b>{{$Rstd_from}}</b> to <b>{{$Rstd_to}}</b>
        </div>

        <div>
            From Acadmic Year : <b>{{$Rfrom_year}}</b> to <b>{{$Rto_year}}</b>
        </div>
    </div>

</x-main-card>

<script>


    enableTransliteration($("#cast")[0], 'kn')
    enableTransliteration($("#subcast")[0], 'kn')
    enableTransliteration($("#religion")[0], 'kn')

    $("#class_from").select2();
    $("#to_year").select2();

    $("#class_to").select2();
    $("#from_year").select2();

    $("#class_from").on("select2:select", function(e){
        $("#std_from").val(e.params.data.text);
    });

    $("#class_to").on("select2:select", function(e){
        $("#std_to").val(e.params.data.text);
    });

    $("#from_year").on("select2:select", function(e){
        $("#from_yr").val(e.params.data.text);
    });

    $("#to_year").on("select2:select", function(e){
        $("#to_yr").val(e.params.data.text);
    });

    function saveStd(id){

        if($("#mt").val() == null || $("#mt").val() == "" || $("#mt").val() == undefined) {
            $("#mtError").text("Enter Mother Tounge");
            return;
        } else {
            $("#mtError").text("");
        }
        
        $.ajax({
            type: "post",
            url: "{{route('certificate.saveStudy')}}",
            data: {
                id: id,
                from_year: $("#from_yr").val(),
                to_year: $("#to_yr").val(),
                std_from: $("#std_from").val(),
                std_to: $("#std_to").val(),
                mt: $("#mt").val(),
                cast: $("#cast").val(),
                subcast: $("#subcast").val(),
                religion: $("#religion").val(),
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