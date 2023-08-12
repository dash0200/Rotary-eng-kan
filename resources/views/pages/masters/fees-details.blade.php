<x-main-card>
    Fees Details
    <div class="p-10 flex justify-evenly">
        <div class="flex flex-col">
            <label for="year" class="p-1">Academic Year</label>
            <select name="year" id="year">
                <option value="">Select Academic Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col">
            <label for="class" class="p-1">Classes</label>
            <select name="class" id="class">
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="w-full flex justify-center">
        <div class="flex flex-col border w-1/4 rounded">

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
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr id="r{{ $fee->id }}">
                            <td align="center">{{ $loop->iteration }}</td>
                            <td align="center">{{ $fee->desc }}</td>
                            <td align="center" id="btn{{ $fee->id }}">
                                <x-input type="number" name="desc_{{ $loop->iteration }}" oninput="calculate()" value="0" id="{{ $fee->id }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="w-full h-full">
                <tr class="border-t">
                    <td colspan="2" align="center" class="border-r">
                        Tuition Fee
                        <x-input type="number" oninput="calculate()" name="tuition" id="tuition" />
                    </td>
                    <td class="h-full">
                        <div class="space-y-10">
                            <div>
                                Total Fees
                                <x-input type="number" name="total" disabled id="total" />
                            </div>

                            <div>
                                Total Months
                                <x-input type="number" name="moths" value="12" id="months" />
                            </div>

                            <div>
                                Fees Per Annum
                                <x-input type="number" disabled name="feePerAnnum" id="feePerAnnum" />
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="p-2 flex justify-between items-center loading">
                <button value="Save" onclick="saveDetails()"
                    class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
               focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">Save
                </button>

                <a href="">
                    <x-button-success value="Clear" />
                </a>
            </div>
        </div>

    </div>
</x-main-card>

<script>
    var descTable;
    $(document).ready(function() {
        descTable = $("#desc").html();
    });
    $("#year").select2();
    $("#class").select2();

    $("#year").on("select2:select", function(e) {
        let data = e.params.data;
        getFeeDetails()
    });
    $("#class").on("select2:select", function(e) {
        let data = e.params.data;
        getFeeDetails()
    });

    function getFeeDetails() {
        let year = $("#year").val();
        let clas = $("#class").val();
        if (year == "" || year == null || clas == '' || clas == null) return;
        $.ajax({
            type: "get",
            url: "{{ route('master.getDetails') }}",
            data: {
                year: year,
                clas: clas
            },
            dataType: "json",

            success: function(res) {
                let amt = res.feeDetails;

                if (amt.length == 0) {
                    for (let i = 1; i <= {{ count($fees) }}; i++) {
                        $(`input[name=desc_${i}]`).val("0")
                    }
                    $("#tuition").val("0")
                } else {
                    $("#tuition").val(amt[0].tuition)
                    for (let i = 0; i < amt.length; i++) {
                        if(amt[i].amount == "" || amt[i].amount == null){
                            $(`#${amt[i].fee_head}`).val("0");
                        } else {
                            $(`#${amt[i].fee_head}`).val(amt[i].amount);
                        }
                        
                    }
                    
                }
                calculate();
            }
        });
    }

    function saveDetails() {

        let year = $("#year").val();
        let clas = $("#class").val();
        let tut = $("#tuition").val();
        let feePerAnnum = $("#feePerAnnum").val()

        if (year == "" || year == null || clas == '' || clas == null) return;

        let amounts = [];

        for (let i = 1; i <= {{ count($fees) }}; i++) {
            amounts.push({
                id: $(`input[name='desc_${i}']`).attr("id"),
                amt: $(`input[name='desc_${i}']`).val()
            })
        }

        $.ajax({
            type: "post",
            url: "{{ route('master.saveDetails') }}",
            data: {
                year: year,
                clas: clas,
                tut: tut,
                amounts: amounts,
                feePerAnnum:feePerAnnum
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
                    `<div class="flex space-x-2 items-center">
                        <button value="Save" onclick="saveDetails()" class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight my-2
                        uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-700 focus:shadow-lg focus:outline-none 
                    focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">Save </button>
                    <svg xmlns="" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    </div>`
                )
                setTimeout(() => {
                    $(".loading svg").html("")
                }, 1500);
            }
        });

    }

    function calculate() {
        var totalDesc = 0;
        for (let i = 1; i <= {{ count($fees) }}; i++) {
            totalDesc = totalDesc + parseInt($(`input[name='desc_${i}']`).val());
        }
        $("#total").val(totalDesc);
        $("#feePerAnnum").val((totalDesc + (12*$("#tuition").val())).toFixed(2)-$("#tuition").val());
    }

    $("#tuition").keyup(function(){
        $("#3").val($("#tuition").val());
    })

    $("#3").keyup(function(){
        $("#tuition").val($("#3").val());
    })
</script>
