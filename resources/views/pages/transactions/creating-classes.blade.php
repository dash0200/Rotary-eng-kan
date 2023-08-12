<x-app-layout>
    <div class="relative ...">
    <div class="py-12">
        <div id="pageLoad">
           
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                Creating Classes
                <div class="w-full bg-gray-200" style="height: 1px;"></div>

                <div class="flex flex-col">
                    <div class="flex space-x-3 w-full justify-around">
                        <div class="m-2">
                            <x-label value="Admission Date" />
                            <select name="year" id="year">
                                <option value="">Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-2">
                            <x-label value="Classes" />
                            <select name="class" id="class">
                                <option value="">Select Year</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-2">
                            <x-label value="Total Amount" />
                            <div class="flex flex-col justify-center">
                                <x-input type="text" disabled id="amt" />
                                <div id="amtError" class="text-red-500"></div>
                                <div id="amtError2" class="text-red-500"></div>
                                <div id="amtLink" class="text-blue-500"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    Search & Add
                    <div class="mt-5">
                        <select name="student" id="stdsearh" class="w-full">
                            <option value="">Enter Student ID</option>
                        </select>
                    </div>
                </div>

                <x-table>

                    <x-thead>
                        <x-th>
                            Register Number
                        </x-th>
                        <x-th>
                            Student Name
                        </x-th>
                        <x-th>
                            Previous Class
                        </x-th>
                        <x-th>
                            Academic Year
                        </x-th>
                        <x-th>
                            Action
                        </x-th>
                    </x-thead>

                    <tbody id="creating">

                    </tbody>

                </x-table>
                <div class="flex justify-center border-t" id="saveLoad">
                    <x-button-primary value="Save" onclick="createClass()" />
                </div>
                <x-table class="border-t">
                    <h2 class="flex justify-center border-t text-blue-400">Already Added Students</h2>
                    <x-thead>
                        <x-th>
                            Register Number
                        </x-th>
                        <x-th>
                            Student Name
                        </x-th>
                        <x-th>
                            Academic Year
                        </x-th>
                    </x-thead>

                    <tbody id="added">

                    </tbody>

                </x-table>
               
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-xl flex justify-center text-violet-600">Newly Admitted Students</h1>
            <div class="flex">
                <div class="mb-3 xl:w-96">
                  <div class="input-group relative flex flex-wrap items-stretch w-full mb-4 rounded">
                    <input type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           id="search" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  </div>
                </div>
              </div>
            <x-table>

                <x-thead>
                    <x-th>
                        Register Number
                    </x-th>
                    <x-th>
                        Student Name
                    </x-th>
                    <x-th>
                        Took Admission for
                    </x-th>
                    <x-th>
                        Academic Year
                    </x-th>
                    <x-th>
                        Action
                    </x-th>
                </x-thead>

                <tbody id="newstd">

                </tbody>

            </x-table>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto my-8 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-xl flex justify-center text-orange-600">Previous Class Students</h1>
            <div class="flex">
                <div class="mb-3 xl:w-96">
                  <div class="input-group relative flex flex-wrap items-stretch w-full mb-4 rounded">
                    <input type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           id="searchPrev" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  </div>
                </div>
              </div>
            <x-table>

                <x-thead>
                    <x-th>
                        Register Number
                    </x-th>
                    <x-th>
                        Student Name
                    </x-th>
                    <x-th>
                        Current Class
                    </x-th>
                    <x-th>
                        Academic Year
                    </x-th>
                    <x-th>
                        Action
                    </x-th>
                </x-thead>

                <tbody id="current">

                </tbody>

            </x-table>
        </div>
        
    </div>
</div>
</x-app-layout>

<script>
    $('#year').select2();
    $('#class').select2();

    $('#year').on("select2:select", function(e) {
        getStudents()
    });
    $('#class').on("select2:select", function(e) {
        getStudents()
    });

    function getStudents() {
        var year = $('#year').val();
        var clas = $('#class').val();
        if (year == "" || year == null || clas == '' || clas == null) return;

        $.ajax({
            type: "get",
            url: "{{ route('trans.getCurrentClass') }}",
            data: {
                year: year,
                clas: clas
            },
            dataType: "json",
           beforeSend: function(){
            $("#pageLoad").html("");
            $("#pageLoad").append(`<x-page-loading />`);
           },
            success: function(res) {
                $("#pageLoad").html("");
                let added = res.addedStd;
                $("#amt").val(res.totalAmt.toFixed(2))
                let news = res.new;
                let prevs = res.old;
                $("#newstd").html("");
                
                res.new.forEach(std => {
                    $("#newstd").append(
                        `<x-body-tr id="trN_${std.id}" class="${std.id}">
                        <x-td-num>
                            ${std.id}
                        </x-td-num>
                        <x-td>
                            ${std.name}
                        </x-td>
                        <x-td>
                            ${std.class}
                        </x-td>
                        <x-td>
                            ${std.year}
                        </x-td>
                        <x-td id="btn${std.id}">
                          <button onclick="moveRow(${std.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                              </svg>
                          </button>
                        </x-td>
                    </x-body-tr>`
                    )
                });

                $("#current").html("");
                
                prevs.forEach(pstd => {
                    $("#current").append(
                        `<x-body-tr id="trPre_${pstd.id}">
                        <x-td-num id="${pstd.id}">
                            ${pstd.id}
                        </x-td-num>
                        <x-td>
                        ${pstd.name}
                        </x-td>
                        <x-td>
                        ${pstd.current_class}
                        </x-td>
                        <x-td>
                        ${pstd.year}
                        </x-td>
                        <x-td id="btnP${pstd.id}">
                          <button onclick="movePrevRow(${pstd.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                              </svg>
                          </button>
                        </x-td>
                    </x-body-tr>`
                    )
                });

                $("#added").html("");
                added.forEach(add => {
                    $("#added").append(
                        `<x-body-tr id="tr_${add.id}" class="${add.id}">
                        <x-td-num>
                            ${add.id}
                        </x-td-num>
                        <x-td>
                            ${add.name}
                        </x-td>
                        
                        <x-td>
                            ${add.year}
                        </x-td>
                        
                    </x-body-tr>`
                    )
                    removeAdmit(`#trPre_${add.id}`)
                });

                $("#amtError").text("");
                $("#amtError2").text("");
                $("#amtLink").html("")
            }, error: function(){
                $("#amtError").text("You have not added fees details for the selected academic year & class");
                $("#amtError2").text("You need to add them before creating class");
                $("#amtLink").append(
                    `
                    <a href="{{route('master.feesDetails')}}"><x-button-success value="Add Fees Details" /></a>
                    `
                );
                $("#amt").val("")
                $("#pageLoad").html("");
            },
            
        });
    }

    function moveRow(id) {
        let trCode = $("#trN_" + id).prop('outerHTML');

        $("#trN_" + id).remove("");
        $("#creating").append(`${trCode}`)

        $(`#btn${id}`).html("")
        $("#btn" + id).append(`
        <button onclick="moveBack(${id})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </button>`)
    }

    function movePrevRow(id) {
        let trCode = $("#trPre_" + id).prop('outerHTML');

        $("#trPre_" + id).remove("");
        $("#creating").append(`${trCode}`)

        $(`#btnP${id}`).html("")
        $("#btnP" + id).append(`
        <button onclick="movePrevBack(${id})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </button>`)
    }

    function movePrevBack(id) {
        let trCode = $("#trPre_" + id).prop('outerHTML');

        $("#trPre_" + id).remove("");
        $("#current").append(`${trCode}`)


        $(`#btnP${id}`).html("")
        $("#btnP" + id).append(`
        <button onclick="movePrevRow(${id})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>`)

    }

    function moveBack(id) {
        let trCode = $("#trN_" + id).prop('outerHTML');

        $("#trN_" + id).remove("");
        $("#newstd").append(`${trCode}`)

        $(`#btn${id}`).html("")
        $("#btn" + id).append(`
            <button onclick="moveRow(${id})">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>`)
    }


    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#newstd").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#searchPrev").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#current").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    
    function createClass() {

        let year = $("#year").val();
        let clas = $("#class").val();
        let amt = $("#amt").val();
        if(amt == "" || amt == null) {
            alert("Total Amount cannot be empty")
            return;
        }
        if (year == "" || year == null || clas == '' || clas == null) return;
        
        let ids = [];
        $("#creating > tr").each(function() {
            ids.push(
                {id: $(this).attr("id").split("_")[1]}
            )
        });

        
        if(ids.length < 1) return;
        
        $.ajax({
            type: "post",
            url: "{{route('trans.createClass')}}",
            data: {
                stds: ids,
                year: year,
                clas: clas,
                amt: amt
            },
            dataType: "json",
            beforeSend: function(){
                $("#saveLoad").html("");
                $("#saveLoad").append(
                    `<x-loading-button/>`
                );
            },
            success: function (res) {
               location.reload();
            }
        });
    }

    function removeAdmit(id) {
        $(id).remove();
    }


    $("#stdsearh").select2({
        ajax: { 
        url: "{{route('getStdId')}}",
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

                $("#creating").append(
                        `<x-body-tr id="sna_${res[0].id}">
                        <x-td-num>
                            ${res[0].id}
                        </x-td-num>
                        <x-td>
                            ${res[0].name}
                        </x-td>
                        <x-td>
                            
                        </x-td>
                        <x-td>
                        </x-td>
                        <x-td id="btn${res[0].id}">
                          <button onclick="deleteSNA('sna_${res[0].id}')">
                            Delete
                          </button>
                        </x-td>
                    </x-body-tr>`
                    )
            }
        });
    })

    function deleteSNA(id){
        $('#'+id).remove();
    }

</script>
