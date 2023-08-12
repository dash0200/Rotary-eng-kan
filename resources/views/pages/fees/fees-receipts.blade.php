<x-main-card>
    Fees Receipt
    <div class="w-full bg-gray-200" style="height: 1px;"></div>
    <div class="mt-5">
        <select name="student" id="stdsearh" class="w-full">
            <option value="">Enter Student ID</option>
        </select>
    </div>
    <div class="flex m-9">
        <div class="w-full">
            <div class="flex justify-between border-2 p-1">
                <div>
                    <x-label value="Admission Type" />
                    <x-input type="text" name="stdtype" id="admType" placeholder="Admission Type" readonly />
                </div>
                <div>
                    <x-label value="Standard" />
                    <x-input type="text" name="standard" placeholder="Standard" readonly />
                </div>
            </div>
           <div class="border-2 p-1">
             <div class="mb-2">
                 <x-label value="Student Name" />
                 <x-input type="text" name="name" placeholder="Student Name" readonly />
             </div>
             <div class="mb-2">
                 <x-label value="Father Name" />
                 <x-input type="text" name="fname" placeholder="Father Name" readonly />
             </div>
           </div>
            <div class="flex justify-between space-x-2 border-2 p-1">
                <div>
                    <x-label value="Receipt Date" />
                    <x-input type="date" value="{{ date('Y-m-d') }}" name="rdate" placeholder="Receipt Date" />
                </div>
                <div>
                    <x-label value="Receipt No" />
                    <x-input type="text" name="receipt_no" id="receipt_no" placeholder="Receipt No" />
                    <span id="receiptError" class="text-red-600"></span>
                </div>
                <div>
                    <x-label value="Financial Year" />
                    <x-input type="text" name="fyear" placeholder="Financial Year" readonly/>
                </div>
            </div>

            <div class="flex justify-between space-x-2 border-2 p-1">

                <div>
                    <x-label value="Annual Fee" />
                    <x-input type="text" name="annualFee" placeholder="Annual Fee" readonly/>
                    
                </div>
                <div>
                    <x-label value="Fees Paid" />
                    <x-input type="text" name="feesPaid" placeholder="Fees Paid" readonly/>
                </div>
                <div>
                    <x-label value="Balance" />
                    <x-input type="text" name="balanceFee" placeholder="Balance Fee" readonly/>
                </div>

            </div>

            <div class="mt-10">
            <h2 class="mb-5">Preveious Balances</h2>
                <div class="flex flex-wrap justify-evenly" id="prev">

                </div>
            </div>
        </div>


        <div class="w-full px-5">
            <x-table>
                <x-thead>
                    <x-th>
                        #
                    </x-th>
                    <x-th>
                        Description
                    </x-th>
                    <x-th>
                        Amount
                    </x-th>
                </x-thead>
                <tbody>
                    
                </tbody>
            </x-table>

            <div id="success">
                <div>
                    <x-label value="Amount Paying" />
                    <x-input type="number" name="paying" placeholder="Amount Paying" class="onlyNum" />
                    <span id="payingError" class="text-red-600"></span>
                </div>

                <input type="text" id="id" hidden placeholder="id"/>
                <span id="btn"></span>
            </div>

        </div>
    </div>
</x-main-card>

<script>

    function saveAmount(student, year, standard) {

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
                if($("input[name='paying']").val() == "" || $("input[name='paying']").val() == null || $("input[name='paying']").val() == undefined) {
            $("#payingError").text("Amount Paying Cannot be Empty");
            return;
        }

        if($("input[name='feesPaid']").val() == "" || $("input[name='feesPaid']").val() == null || $("input[name='feesPaid']").val() == undefined) return;
        if($("input[name='balanceFee']").val() == "" || $("input[name='balanceFee']").val() == null || $("input[name='balanceFee']").val() == undefined) return;

        $.ajax({
            type: "post",
            url: "{{route('fees.savePaidFees')}}",
            data: {
                id:$("#id").val(),
                annualFee:$("input[name='annualFee']").val(),
                feesPaid:$("input[name='feesPaid']").val(),
                balance:$("input[name='balanceFee']").val(),
                paying:$("input[name='paying']").val(),
                student: student,
                year: year,
                class: standard,
                receipt_no: $("#receipt_no").val()
            },
            dataType: "json",
            success: function (res) {
                $("#success").append(
                    `<span class="text-green-500">success</span>`
                );

                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
            }
        })
        
        
    }

    function savePrevAmount(annualFee, feesPaid, balance, id, year, student, standard) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed){
                if( $("#paying"+id).val() == null ||  $("#paying"+id).val() == undefined ||  $("#paying"+id).val() == "") return;
               
                $.ajax({
                    type: "post",
                    url: "{{route('fees.savePaidFees')}}",
                    data: {
                        id: id,
                        annualFee: annualFee,
                        feesPaid: feesPaid,
                        balance: balance,
                        paying: $("#paying"+id).val(),
                        student: student,
                        year: year,
                        class: standard,
                        receipt_no: $("#receipt"+id).val()
                    },
                    dataType: "json",
                    success: function (res) {
                        $("#success"+id).append(
                            `<span class="text-green-500">success</span>`
                        );
                    }
                });
            }
        })
        
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
    });

    $("#stdsearh").on("select2:select", function(e){
        let data = e.params.data;
        
        $.ajax({
            type: "get",
            url: "{{route('getstudent')}}",
            data: {
                id: data.id
            },
            dataType: "json",
            success: function (res) {
                console.log(res);
                if(parseInt(res.doy) == new Date().getFullYear()) {
                    $("#admType").val("NEW")
                } else {
                    $("#admType").val("OLD")
                }
                $("#id").val(res[1].id)
                $("input[name='standard']").val(res[1].std.name)
                $("input[name='fyear']").val(res[1].aca_year.year)
                $("input[name='name']").val(res[0].name)
                $("input[name='fname']").val(res[0].fname)

                $("input[name='annualFee']").val(res[1].total)
                $("input[name='feesPaid']").val(res[1].paid)
                $("input[name='balanceFee']").val(res[1].balance)
                $("#btn").html("")
                if(res[1].balance == 0) {
                    $("#btn").append(`
                    <x-button-primary value="No Balance"/>
                `)
                } else {
                    $("#btn").append(`
                    <x-button-primary value="Submit" onclick="saveAmount('${res[0].id}', '${res[1].year}', '${res[1].standard}')"/>
                `)
                }

                $("tbody").html("");
                for(let i=0; i < res[2].length; i++) {
                    $("tbody").append(
                        `
                        <x-body-tr>
                            <x-td class="py-0 cursor-pointer">
                                ${i+1}
                            </x-td>
                            <x-td class="py-0 cursor-pointer">
                                ${res[2][i].name}
                            </x-td>
                            <x-td class="py-0 cursor-pointer">
                                ${res[2][i].amount}
                            </x-td>
                        </x-body-tr>
                    `
                    );
                }

                $("#prev").html("");
                for(let i=1; i < res.prev.length; i++){
                    if(parseInt(res.prev[i].balance) == 0) {
                        continue;
                    }
                    $("#prev").append(
                        `<div class="border border-orange-500 py-2 px-1 my-2">
                        <div  class="flex justify-between space-x-2">
                        <div class="border-r">
                            <x-label value="Standard" />
                            <x-input type="text" value="${res.prev[i].std.name}" readonly/>
                        </div>
                        <div class="border-r">
                            <x-label value="Financial Year" />
                            <x-input type="text" value="${res.prev[i].aca_year.year}" readonly/>
                        </div>
                        <div class="border-r">
                            <x-label value="Annual Fee" />
                            <x-input type="text" value="${res.prev[i].total}" readonly/>
                        </div>
                        <div class="border-r">
                            <x-label value="Fee Paid" />
                            <x-input type="text" value="${res.prev[i].paid}" readonly/>
                        </div>
                        <div class="border-r">
                            <x-label value="Balance" />
                            <x-input type="text" value="${res.prev[i].balance}" readonly/>
                        </div>
                    </div>
                    <div>
                        <x-table>
                            <x-thead>
                                <x-th>
                                    #
                                </x-th>
                                <x-th>
                                    Description
                                </x-th>
                                <x-th>
                                    Amount
                                </x-th>
                            </x-thead>
                            <tbody id="feeBody${res.prev[i].id}">
                               
                            </tbody>
                        </x-table>
                    </div>
                    <div class="pb-2" id="sbm">
                        <x-label value="Receipt No" />
                        <x-input class="w-1/2" type="text" placeholder="Receipt No" id="receipt${res.prev[i].id}"/>
                        <span id="rerror${res.prev[i].id}" class="text-red-600"></span>
                        <x-label value="Amount Paying" />
                        <x-input type="number" placeholder="Amount Paying" id="paying${res.prev[i].id}" class="onlyNum" />
                        <div class="flex justify-center items-center" >
                            <x-button-primary value="Submit" 
                             onclick="savePrevAmount(${res.prev[i].total},${res.prev[i].paid},${res.prev[i].balance},'${res.prev[i].id}', '${res.prev[i].year}', '${res.prev[i].student}', '${res.prev[i].standard}' )"
                            />

                            <div id="success${res.prev[i].id}"></div>
                        </div>
                    </div>
                    </div>
                        `
                    )   
                }       
                
                for(let i=1; i < res.prev.length; i++){
                    
                    if(parseInt(res.prev[i].balance) == 0) {
                        continue;
                    }

                    for(let j=0; j < res.prev[i].fees.length; j++) {
                        $(`#feeBody${res.prev[i].id}`).append(
                            `
                        <x-body-tr>
                            <x-td class="py-0 cursor-pointer">
                                ${j+1}
                            </x-td>
                            <x-td class="py-0 cursor-pointer">
                                ${res.prev[i].fees[j].name}
                            </x-td>
                            <x-td class="py-0 cursor-pointer">
                                ${res.prev[i].fees[j].amount}
                            </x-td>
                        </x-body-tr>
                            `
                        )
                    }

                }
            }
        });
    })

</script>
