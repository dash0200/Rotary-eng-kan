<x-main-card>
    <div class="flex justify-end">
        <a href="{{route('trans.searchLC')}}">
            <x-button-primary value="Search LC" />
        </a>
    </div>
    <div>
        <x-label value="Register Number" />
        <select name="student" id="stdsearh" class="w-full">
            <option value="">Enter Student ID</option>
        </select>
    </div>
    <div>
        <x-table>
            <x-thead>
                <x-th>
                    Register No
                 </x-th>
                 <x-th>
                    STS
                 </x-th>
                <x-th>
                    Name
                </x-th>
                <x-th>
                   Father Name
                </x-th>
                <x-th>
                    Mother Name
                 </x-th>
                 <x-th>
                    Surname
                 </x-th>
                 <x-th>
                    DOB
                 </x-th>
            </x-thead>
            <tbody id="adm">
                
            </tbody>
        </x-table>  
    </div>


    <div>
        Last Class & Academic Year
        <x-table>
            <x-thead>
                <x-th>
                   Class
                 </x-th>
                 <x-th>
                    Academic Year
                 </x-th>
            </x-thead>
            <tbody id="lastCls">
                
            </tbody>
        </x-table>  
    </div>
    Leaving Certificate
    <div class="w-full bg-gray-200" style="height: 1px;"></div>
    <div class="flex flex-col space-y-4">
        <div class="flex space-x-2 mt-5 items-center justify-around">
            <div>
                <x-label value="Studied Till Class" />
                <select name="class" id="class" required>
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <span id="tillClassError" class="text-red-500"></span>
            </div>
            <div>
                <x-label value="Till Academic Year" />
                <select name="year" id="year" required>
                    <option value="">Select Year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                    @endforeach
                </select>
                <span id="tillYearError" class="text-red-500"></span>
            </div>
        </div>

        <div class="flex justify-between mt-5 space-x-2">
            <div class="w-full">
                <x-label value="WAS STUDYING WHILE LEAVING" />
                <x-input name="wasStd" placeholder="WAS STUDYING WHILE LEAVING" />
            </div>
            <div class="w-full">
                <x-label value="WHETHER QUALIFIED FOR PROMOTION" />
                <x-input name="qualif" placeholder="WHETHER QUALIFIED FOR PROMOTION" />
            </div>
        </div>
        
        <div class="flex justify-between mt-5 space-x-2">
            <div class="w-full">
                <x-label value="LAST ATTENDANCE" />
                <x-input type="date" name="la" />
                <span id="laError" class="text-red-500"></span>
            </div>
            <div class="w-full">
                <x-label value="DATE OF APPLICATION" />
                <x-input type="date" name="dop" value="{{date('Y-m-d')}}" />
            </div>
            <div class="w-full">
                <x-label value="DATE OF ISSUING L.C" />
                <x-input type="date" name="doi" value="{{date('Y-m-d')}}" />
            </div>
            <div class="w-full">
                <x-label value="REASON for Leaving the School" />
                <x-input type="text" name="reason" value="PARENTS REQUEST" />
            </div>
        </div>

        <div class="flex justify-between mt-5 space-x-2">
            <div>
                <x-label value="ADMITTED TO CLASS" />
                <x-input type="text" name="atc" />
            </div>

            <div>
                <x-label value="ADMITTED YEAR" />
                <x-input type="text" name="ay" />
            </div>

            <div>
                <x-label value="DATE OF ADMISSION" />
                <x-input type="text" name="doa" />
            </div>

            <div>
                <x-label value="STUDYING IN" />
                <x-input type="text" name="stdin" />
            </div>

            <div>
                <x-label value="CURRENT YEAR" />
                <x-input type="text" name="cy" value="{{date('Y')}}" />
            </div>
        </div>

        <div class="flex mt-5 justify-between space-x-2">

            <div>
                <x-label value="Student Name" />
                <x-input type="text" id="name" />
            </div>

            <div>
                <x-label value="Father Name" />
                <x-input type="text" id="father" />
            </div>

            <div>
                <x-label value="MOTHER NAME" />
                <x-input type="text" id="mother" />
            </div>

            <div>
                <x-label value="SUR NAME" />
                <x-input type="text" id="sur" />
            </div>

        </div>
        
        <div class="flex mt-5 justify-center" id="save">
            
        </div>
    </div>
</x-main-card>

<script>
    
    $("#class").select2()
    $("#year").select2()

    function submitLC(id) {

        if($("#class").val() == null || $("#class").val() == "" || $("#class").val() == undefined) {
            $("#tillClassError").text("Select Class")
            return 
        } else {
            $("#tillClassError").text("");
        }

        if($("#year").val() == null || $("#year").val() == "" || $("#year").val() == undefined) {
            $("#tillYearError").text("Select Year")
            return 
        } else {
            $("#tillYearError").text("");
        }

        if($("input[name='la']").val() == null || $("input[name='la']").val() == "" || $("input[name='la']").val() == undefined) {
            $("#laError").text("Enter Last Attendance")
            return 
        } else {
            $("#laError").text("");
        }
        
        $.ajax({
            type: "post",
            url: "{{route('trans.saveLc')}}",
            data: {
                id:id,
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
                console.log(res.lc);
                // window.open('/transaction/print-lc?id=${res.lc}', '_blank');

                // location.reload()
            }
        });
    }
    
    $("#stdsearh").select2({
        ajax: { 
        url: "{{route('trans.getStdId')}}",
        type: "get",
        dataType: 'json',
        data: function (params) {
            return {
                term: params.term // search term
            };
        },
        processResults: function (response) {
            return {
                results: response
            };
        },
        cache: true
        }
    })

    $("#stdsearh").on("select2:select", function(e){
        let data = e.params.data;
        $.ajax({
            type: "get",
            url: "{{route('trans.getStuddent')}}",
            data: {
                id: data.id
            },
            dataType: "json",
            success: function (res) {

                
                console.log(res[1]);
                $("#adm").html('')
                $("#adm").append(
                    `
                    <x-body-tr>

                        <x-td>
                            ${res[0].id}
                        </x-td>

                        <x-td>
                            ${res[0].sts}
                        </x-td>

                        <x-td>
                            ${res[0].name}
                        </x-td>

                        <x-td>
                            ${res[0].fname}
                        </x-td>

                        <x-td>
                            ${res[0].mname}
                        </x-td>

                        <x-td>
                            ${res[0].lname}
                        </x-td>

                        <x-td>
                            ${res[0].dob1}
                        </x-td>
                        
                    </x-body-tr>
                    `
                )
                
                $("#lastCls").html('')
                $("#lastCls").append(
                    `
                    <x-body-tr>
                        <x-td>
                            ${res[1] == '' ? '' : res[1].std.name}
                        </x-td>

                        <x-td>
                            ${res[1] == '' ? '' : res[1].aca_year.year}
                        </x-td>
                    </x-body-tr>
                    `
                )
                $("#save").html('')
                $("#save").append(
                    `
                    <x-button-primary class="w-1/4" value="SUBMIT" id="svBtn" onclick="submitLC('${res[0].id}', )" />
                    `
                )

                $("input[name='wasStd']").val(`WAS STUDYING IN ${res[1] == '' ? '' : res[1].std.name} CLASS`)
                $("input[name='qualif']").val(`YES QUALIFIED FOR  ${res[2].name} CLASS`)
                $("input[name='atc']").val(`${res[0].classes.name}`)
                $("input[name='ay']").val(`${res[0].aca_year.year}`)
                $("input[name='doa']").val(`${res[0].doy}`)
                $("input[name='stdin']").val(`${res[1] == '' ? '' : res[1].std.name}`)

                $("#name").val(`${res[0].name}`)
                $("#fname").val(`${res[0].fname}`)
                $("#mname").val(`${res[0].mname}`)
                $("#sur").val(`${res[0].lname}`)
            }
        });
    })


</script>