<x-main-card>
       <div class="flex flex-col space-y-4">   
        <div>
            <x-label value="Enter LC Number" />
            <x-input type="text" id="id" placeholder="Leaving Certificate Number" />
            <x-button-primary value="Submit" onclick="getById()" />
        </div>
    </div>

    <div>
        <x-table>
            <x-thead>
                <x-th>
                    LC No
                </x-th>
                <x-th>
                    Name
                </x-th>
                <x-th>
                    Middle Name
                </x-th>
                <x-th>
                    Surname
                </x-th>
            </x-thead>
            
            <tbody id="byId">
                
            </tbody>
        </x-table>
    </div>

</x-main-card>

<script>
    $("#year").select2();

    function getById() {
        $.ajax({
            type: "get",
            url: "{{route('trans.getLC')}}",
            data: {
                id: $("#id").val(),
            },
            dataType: "json",
            beforeSend: function(){
                $("#byId").html("");
                $("#byId").append(
                    `<x-loading-button/>`
                );
            },
            success: function (res) {
                $("#byId").html("")
                
                res.forEach(std => {
                    appendData(std)
                });
            }
        });
    }

    function appendData(res){
        $("#byId").append(
                    `
            <tr>
            <x-td>
                ${res.id}
            </x-td>
            <x-td>
                ${res.name} <b>(${res.student})</b>
            </x-td>
            <x-td>
                ${res.fname}
            </x-td>
            <x-td>
                ${res.lname}
            </x-td>

            <x-td>
                <form action="{{route('trans.printLC')}}" method="get">
                    <input type="text" name="id" value="${res.student_ide}" hidden>
                    <x-button-primary value="PRINT" />
                </form>

                <form action="{{route('trans.editLC')}}" method="get">
                    <input type="text" name="id" value="${res.lc_ide}" hidden>
                    <x-button-primary value="EDIT" />
                </form>
            </x-td>
            </tr>
            `
        )
    }
</script>