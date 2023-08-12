<script type="text/javascript" src="{{ asset('js/transliteration-input.bundle.js') }}"></script>

<x-main-card>
    Cast Details
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <div class="p-10 flex justify-around">
        <div class="flex flex-col justify-evenly">
            <h1>Add Category</h1>
            <div class="border-b ">
                <x-input type="text" name="cat" id="cat" placeholder="Category" />
                <div class="loading">
                    <button
                        class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                    uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
                   focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out"
                        onclick="catSave()">Save</button>
                </div>
            </div>
            <div>
                <table>
                    <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Categories
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="categories">

                    </tbody>
                </table>
            </div>
        </div>

        <div>

            <div class="border p-2 my-10">
                <h2>Add Caste</h2>
                <form id="casteForm" class="flex items-center justify-evenly space-x-2">
                    <select name="cats" id="cats">
                        <option value="">Select Category</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <x-input type="text" name="caste" id="caste" placeholder="Caste" />
                    <div class="loading">
                        <x-button-primary value="Save" />
                    </div>
                </form>
            </div>


            <div class="flex flex-col border p-2 mb-10">
                <div class="flex justify-around">
                    <div class="flex flex-col">
                        <select name="cast" id="cast" required>
                            <option value="">Select Caste</option>
                            @foreach ($castes as $cast)
                                <option value="{{ $cast->id }}">{{ $cast->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-xs">Select Cast and enter its subcast below to save</span>
                    </div>
                    <div>
                        <x-input type="text" name="subcast" id="subcast" placeholder="Enter Sub Caste" required />
                    </div>
                </div>
                <div class="loading">
                    <button
                        class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                        uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
                        focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out"
                        onclick="saveSubCast()">Save Subcaste</button>
                </div>

                <table class="w-full">
                    <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                sub-cast
                            </th>
                        </tr>
                    </thead>
                    <tbody id="sub_cast">

                    </tbody>
                </table>

            </div>

            <div class="border">
                <div class="mt-5 flex space-x-2 items-center justify-around">
                    <select name="searchcat" id="searchcat">
                        <option value="">Select Cat</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <span>OR</span>
                    <div class="flex flex-col">
                        <select name="searchcast" id="searchcast">
                            <option value="">Select Caste</option>
                            @foreach ($castes as $cast)
                                <option value="{{ $cast->id }}">{{ $cast->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="text-xs ml-10">Select either one to show its corresponding category or caste</div>
                <div>
                    <table class="w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left th">
                                    Categories
                                </th>
                            </tr>
                        </thead>
                        <tbody id="searchCast">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-main-card>
<script>
    $(document).ready(function() {
        getCategories()
    });

    enableTransliteration($("#caste")[0], 'kn')
    enableTransliteration($("#subcast")[0], 'kn')

    $("#cats").select2();
    $("#searchcat").select2();
    $("#cast").select2();
    $("#searchcast").select2();

    $("#cast").on("select2:select", function(e) {
        let data = e.params.data;
        $.ajax({
            type: "get",
            url: "{{ route('master.searchSubcast') }}",
            data: {
                cast: data.id
            },
            dataType: "json",
            success: function(res) {
                $("#sub_cast").html("");
                let cast = res.subCast;
                if (cast.length > 0) {
                    for (var i = 0; i < cast.length; i++) {
                        $("#sub_cast").append(
                            `<tr id="tr${cast[i].id}" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${i+1}</td>
                            
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${cast[i].name}
                            </td>
                        </tr>`
                        )
                    }
                } else {
                    $("#sub_cast").append(
                        `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 text-gray-900" align="center" colspan="3">
                                No Data
                            </td>
                        </tr>`
                    )
                }

            }
        });
    });

    $("#searchcast").on("select2:select", function(e) {
        let data = e.params.data;

        $.ajax({
            type: "get",
            url: "{{ route('master.searchCat') }}",
            data: {
                cast: data.text
            },
            dataType: "json",
            success: function(res) {
                $("#searchcat").val("")
                $("#searchCast").html("");
                $(".th").html("");
                $(".th").text("Category");
                let cast = res.cats;
                if (cast.length > 0) {
                    for (var i = 0; i < cast.length; i++) {
                        $("#searchCast").append(
                            `<tr id="tr${cast[i].id}" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${i+1}</td>
                            
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${cast[i].cat_name}
                            </td>
                        </tr>`
                        )
                    }
                } else {
                    $("#searchCast").append(
                        `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 text-gray-900" align="center" colspan="3">
                                No Data
                            </td>
                        </tr>`
                    )
                }

            }
        });
    });

    $("#searchcat").on("select2:select", function(e) {
        let data = e.params.data;

        $.ajax({
            type: "get",
            url: "{{ route('master.searchCast') }}",
            data: {
                cat: data.id
            },
            dataType: "json",
            success: function(res) {
                $("#searchcast").val(null);
                $("#searchCast").html("");
                $(".th").html("");
                $(".th").text("Cast");
                let cast = res.casts;
                if (cast.length > 0) {
                    for (var i = 0; i < cast.length; i++) {
                        $("#searchCast").append(
                            `<tr id="tr${cast[i].id}" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${i+1}</td>
                            
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${cast[i].name}
                            </td>
                        </tr>`
                        )
                    }
                } else {
                    $("#searchCast").append(
                        `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 text-gray-900" align="center" colspan="3">
                                No Data
                            </td>
                        </tr>`
                    )
                }

            }
        });

    });



    $("#casteForm").submit(function(e) {
        e.preventDefault();
        let caste = $("#caste").val()
        let cat = $("#cats").val()

        $.ajax({
            type: "post",
            url: "{{ route('master.saveCaste') }}",
            data: {
                caste: caste,
                cat: cat
            },
            dataType: "json",
            beforeSend: function() {
                $(".loading").html("")
                $(".loading").append(
                    `<x-loading-button name="Saving" />`
                )
            },
            success: function(response) {
                $(".loading").html("")
                $(".loading").append(
                    `
                    <div class="flex space-x-2 items-center">
                        <x-button-primary value="Save" />
                    <svg xmlns="" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    </div>
                    `
                )
            }
        });
    });

    function getCategories() {
        $.ajax({
            type: "get",
            url: "{{ route('master.getCategories') }}",
            dataType: "json",
            success: function(res) {
                let cats = res.cats;
                if (cats.length < 1) {
                    $("tbody").html("")
                    $("tbody").append(
                        `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td align="center" colspan="2" class="text-red-300">
                            No Categories
                        </td>
                        </tr>`
                    )
                } else {
                    $("tbody").html("");
                    for (let i = 0; i < cats.length; i++) {
                        $('#categories').append(
                            `<tr id="tr${cats[i].id}" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${i+1}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${cats[i].name}
                            </td>
                            <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               <div id="catUp${cats[i].id}">
                                 <button class="cursor-pointer p-1 border rounded-full " id="edit${cats[i].id}" onclick="editCat('${cats[i].id}', '${i+1}', '${cats[i].name}')">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                     </svg>
                                 </button>
                               </div>
                            </td>
                        </tr>`
                        );
                    }
                }
            }
        });
    }

    function editCat(id, n, val) {
        $("#tr" + id).html("");
        $("#tr" + id).append(
            `<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${n}</td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <x-input type="text" value="${val}" id="ed${id}"/>
            </td>
            <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <button class="cursor-pointer" onclick="updateCat('${id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 border-2 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </td>`
        );
    }

    function updateCat(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let val = $("#ed" + id).val();

                if (val == null || val == "" || val == undefined) return;

                $.ajax({
                    type: "PUT",
                    url: "{{ route('master.updateCat') }}",
                    data: {
                        id: id,
                        val: val
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $("#catUp" + id).html("");
                        $("#catUp" + id).append(
                            `<svg role="status" class="w-4 h-4 mr-2 p-1 border rounded-full text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>`
                        );
                    },
                    success: function(response) {
                        getCategories();
                    }
                });
            }
        })
    }

    function catSave() {
        $.ajax({
            type: "post",
            url: "{{ route('master.saveCategory') }}",
            data: {
                name: $("#cat").val()
            },
            dataType: "json",
            beforeSend: function() {
                $(".loading").html("")
                $(".loading").append(
                    `<x-loading-button name="Saving" />`
                )
            },
            success: function(response) {
                $(".loading").html("")
                $(".loading").append(
                    `
                    <button class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                    uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
                   focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out" onclick="catSave()">Save</button>
                    </div>
                    `
                )
                getCategories();
            }
        });
    }

    function saveSubCast() {
        let cast = $("#cast").val()
        let sub = $("#subcast").val()
        if (cast == "" || cast == null || sub == null || sub == "") return;
        $.ajax({
            type: "post",
            url: "{{ route('master.subCast') }}",
            data: {
                cast: cast,
                sub: sub
            },
            dataType: "json",
            beforeSend: function() {
                $(".loading").html("")
                $(".loading").append(
                    `<x-loading-button name="Saving" />`
                )
            },
            success: function(res) {
                $(".loading").html("")
                $(".loading").append(
                    ` <button
                        class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                            uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
                            focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out"
                        onclick="saveSubCast()">Save</button>`
                )
            }
        });
    }
</script>
