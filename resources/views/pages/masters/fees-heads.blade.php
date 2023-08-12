<!-- <script type="text/javascript" src="{{ asset('js/transliteration-input.bundle.js') }}"></script> -->

<x-main-card>
    <div class="">Fees Head</div>
    <div class="p-10 flex justify-around">
        <form class="w-full">
            <div class="relative z-0 w-1/4 mb-6 group">
                <x-label value="Fee Description" for="name" />
                <x-input type="text" name="name" id="name" placeholder="Description" />
            </div>
            <div class="loading">
                <x-button-primary value="Save" />
            </div>
        </form>

        <div class="flex flex-col w-full">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <div class="w-full">
                            <button data-tooltip-target="tooltip-default" onclick="getFees()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                            <div id="tooltip-default" role="tooltip"
                                class="inline-block absolute invisible z-10 py-1 px-1.5 text-sm font-medium text-white bg-violet-400 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                Refresh
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                        <table>
                            <thead class="bg-white border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Fee Description
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-main-card>

<script>
    $(document).ready(function() {
        getFees();
    });

    // enableTransliteration($("#name")[0], 'kn')

    function getFees() {
        $.ajax({
            type: "get",
            url: "{{ route('master.getFeesDesc') }}",
            dataType: "json",
            beforeSend: function() {
                $('tbody').html("");
                $('tbody').append(
                    `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td align="center" colspan="3">
                            <svg role="status" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </td>
                    </tr>`
                );
            },
            success: function(res) {
                let fees = res.fees;
                $('tbody').html("");
                if (fees.length > 0) {
                    for (let i = 0; i < fees.length; i++) {
                        $('tbody').append(
                            `<tr id="tr${fees[i].id}" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${i+1}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${fees[i].desc}
                            </td>
                            <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <button class="cursor-pointer" id="edit${fees[i].id}" onclick="editFee('${fees[i].id}', '${i+1}', '${fees[i].desc}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>`
                        );
                    }
                } else {
                    $('tbody').append(
                        `<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td align="center" colspan="2" class="text-red-300">
                            No Description
                        </td>
                        </tr>`
                    );
                }

            }
        });
    }

    function editFee(id, n, desc) {
        $("#tr" + id).html("");
        $("#tr" + id).append(
            `<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${n}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               <x-input type="text" value="${desc}" id="ed${id}"/>
                            </td>
                            <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <button class="cursor-pointer" onclick="updateFee('${id}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 border-2 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                
                            </td>`
        );
    }

    function updateFee(id) {
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
                    url: "{{ route('master.updateFee') }}",
                    data: {
                        id: id,
                        val: val
                    },
                    dataType: "json",
                    success: function(response) {
                        getFees();
                    }
                });
            }
        })


    }


    $("form").submit(function(e) {
        e.preventDefault();
        var desc = $("#name").val();
        if(desc == "" || desc == undefined || desc  == null) return;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    type: "post",
                    url: "{{ route('master.saveFeesDesc') }}",
                    data: {
                        description: $("#name").val()
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
                        
                        
                        var row = isNaN(parseInt($("tbody tr:last td:first").text())) ? 0 : parseInt($("tbody tr:last td:first").text());

                        $('tbody').append(`<tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${row+1}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                ${desc}
                            </td>
                        </tr>`);

                        $("#name").val('')
                    },
                    error: function(xhr, status, error) {
                        let err = JSON.parse(xhr.responseText);
                        $(".loading").html("")
                        $(".loading").append(
                            `
                    <div class="flex space-x-2 items-center">
                        <x-button-primary value="Save" />
                        <div class="text-red-400 text-sm">
                            ${err.message}
                        </div>
                    </div>
                    `
                        )
                    }
                });
            }
        })

    });
</script>
