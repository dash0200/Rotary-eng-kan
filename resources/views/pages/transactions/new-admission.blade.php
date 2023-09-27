<script type="text/javascript" src="{{ url('js/transliteration-input.bundle.js') }}"></script>
<x-main-card>
    <div class="flex justify-between">
        <a href="{{route('trans.editPage')}}">
            <x-button-primary value="Edit Student Information" />
        </a>
        <div id="google_translate_element"></div>

       <div>
        Registration No: <b>{{$id}}</b>
       </div>
    </div>
    New Admission
    <div class="w-full bg-gray-200" style="height: 1px;"></div>
    
    <form action="{{ route('trans.saveAdmission') }}" method="post">
        @csrf
        <div class="flex flex-col justify-around">
            <div class="flex justify-around">
                <!-- <div class="m-2 w-full">
                    <x-label value="STS" />
                    <x-input type="text" name="sts" id='reg' oninput='checkReg()' placeholder="SST" />
			            <span style='color:green' id='ok'></span>
                    	<span style='color:red' id='notok'></span>
                </div> -->

                <div class="m-2 w-full">
                    <x-label value="Reg no" />
                    <x-input type="text" name="reg" id='reg' oninput='checkReg()' placeholder="Reg No" />
                    <span style='color:green' id='ok'></span>
                    <span style='color:red' id='notok'></span>
                </div>

                <div class="m-2 w-full">
                    <x-label value="Student Name" />
                    <x-input type="text" placeholder="First Name"
                        class="{{ $errors->has('fname') ? 'is-invalid' : '' }}" name="fname" required
                        class="alphaonly" />
                </div>
                <div class="m-2 w-full">
                    <x-label value="City" />
                    <select name="city" id="city" class="w-full">
                        <option value="">Select City</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="Admission Date" />
                    <x-input type="date" name="admDate"
                        class="{{ $errors->has('admDate') ? 'is-invalid' : '' }}" required
                        value="{{ date('Y-m-d') }}" placeholder="Pick Date" />
                </div>
                <div class="m-2 w-full">
                    <x-label value="Father Name" />
                    <x-input type="text" placeholder="Father Name" name="father" class="alphaonly" />
                </div>
                <div class="m-2 w-full">
                    <x-label value="Phone Number" />
                    <x-input type="text" placeholder="Phone" name="phone" class="numOnly" />
                </div>
            </div>
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="Classes" />
                    <select name="class" id="class" required
                        class="{{ $errors->has('class') ? 'is-invalid' : '' }} w-full">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Mother Name" />
                    <x-input type="text" placeholder="Mother Name" name="mname" class="alphaonly" />
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Mobile Number" />
                    <x-input type="text" placeholder="Mobile" name="mobile" class="numOnly" />
                </div>
            </div>
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="Address" />
                    <textarea class="resize-y w-full h-11 rounded-md" id="address" name="address" required></textarea>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Sur Name" />
                    <x-input type="text" placeholder="Sur Name" name="surname" class="alphaonly" />
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Date of Birth" />
                    <x-input type="date" placeholder="DOB" name="dob" required 
                        max="{{ date('Y-m-d') }}" />
                </div>
            </div>
            
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="Birth Place" />
                    <x-input type="text" placeholder="Birth Place" name="birthPlace" class="alphaonly" />
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Caste" />
                    <select name="caste" id="caste" class="w-full" required>
                        <option value="">Select Caste</option>
                        @foreach ($castes as $caste)
                            <option value="{{ $caste->id }}">{{ $caste->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Gender" />
                    <div class="flex justify-around">
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                value="1" type="radio" checked name="gender" id="male">
                            <label class="form-check-label inline-block text-gray-800" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                value="0" type="radio" name="gender" id="female">
                            <label class="form-check-label inline-block text-gray-800" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="State" />
                    <select name="states" id="states" class="w-full">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}">
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    <input id="slectedState" type="text" hidden />
                </div>
    
                <div class="m-2 w-full ">
                    <x-label value="Sub Caste" />
                    <select name="subc" id="subc" class="w-full">
                    </select>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Handicap ?" />
                        <div class="flex justify-around">
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    value="0" type="radio" checked name="handicap" id="no">
                                <label class="form-check-label inline-block text-gray-800" for="no">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    value="1" type="radio" name="handicap" id="yes">
                                <label class="form-check-label inline-block text-gray-800" for="yes">
                                    Yes
                                </label>
                            </div>
                        </div>
                </div>
            </div>
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="District" />
                    <select name="district" id="district" class="w-full">
                        <option value="">--</option>
                    </select>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="cat" />
                    <select name="cat" id="cat" required class="w-full">
                        <option value="">Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{$cat->id}}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
    
    
                <div class="m-2 w-full">
                    <x-label value="Year" />
                    <select name="ac_year" id="year" class="w-full" required>
                        <option value="">Academic Year</option>
                        @foreach ($years as $year)
                            <option value="{{$year->id}}" @if($acaYear == $year->id) selected @endif>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="flex justify-around">
                <div class="m-2 w-full">
                    <x-label value="Taluk" />
                    <select name="taluk" id="taluk" class="w-full">
                        <option value="">--</option>
                    </select>
                </div>
    
                <div class="m-2 w-full">
                    <x-label value="Religion" />
                    <x-input type="text" name="religion" id="religion" />
                </div>  
    
                <div class="m-2 w-full">
                    <x-label value="nationality" />
                    <select name="nationality" id="nationality" class="w-full">
                        <option value="INDIAN">Indian</option>
                    </select>
                </div>
            </div>
        </div>
            <x-label value="Previous School" />
            <x-input type="text" name="prevSchool" />

            <input type="text" name="id" id="id" hidden>
            <x-button-primary value="Save" class="w-full"/>
    </form>
</x-main-card>

<script>

    enableTransliteration($("input[name='fname']")[0], 'kn')
    enableTransliteration($("input[name='father']")[0], 'kn')
    enableTransliteration($("input[name='mname']")[0], 'kn')
    enableTransliteration($("input[name='surname']")[0], 'kn')
    enableTransliteration($("input[name='birthPlace']")[0], 'kn')
    enableTransliteration($("input[name='religion']")[0], 'kn')
    enableTransliteration($("input[name='prevSchool']")[0], 'kn')
    enableTransliteration($("#address")[0], 'kn')
    
    $("#editStd").select2();
    $("#class").select2();
    $("#city").select2();
    $('#states').select2();
    $('#district').select2();
    $('#taluk').select2();
    $('#caste').select2();
    $('#subc').select2();
    $('#cat').select2();
    $('#year').select2();

    $('#caste').on("select2:select", function(e) {
        let data = e.params.data;
        cat(data.id)
    });

    $('#states').on("select2:select", function(e) {
        let data = e.params.data;
        dist(data.id)
    });

    $('#district').on("select2:select", function(e) {
        let data = e.params.data;
        taluk(data.id)
    })

    $(document).ready(function() {
        dist(11)
        taluk(1)
    });

    function dist(id) {
        $.ajax({
            url: "{{ route('trans.getDistrict') }}",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                // dists = [{"id":1, "text":"sdfdsf"}];
                $("#district").html("")
                $("#district").append(`<option value="">--</option>`)
                for (let i = 0; i < data.length; i++) {
                    $("#district").append(
                        `
                        <option value="${data[i].id}"> ${data[i].text} </option>
                        `
                    )
                }
            },
        });
    }

    function taluk(id) {
        $.ajax({
            url: "{{ route('trans.getTaluk') }}",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $("#taluk").html("")
                $("#taluk").append(`<option value="">--</option>`)
                for (let i = 0; i < data.length; i++) {
                    $("#taluk").append(
                        `
                        <option value="${data[i].id}"> ${data[i].text} </option>`
                    )
                }
            },
        });
    }

    function cat(id) {
        $.ajax({
            url: "{{ route('trans.getCat') }}",
            dataType: 'json',
            data: {
                cast: id
            },
            success: function(res) {
                $('#cat').val(res.cats[0].cat).trigger('change')
                let subs = res.subcasts;
                $("#subc").html("")
                for (let i = 0; i < subs.length; i++) {
                    $("#subc").append(
                        `<option value="${subs[i].id}"> ${subs[i].name} </option>`
                    )
                }
            },
        });
    }

    $('.numOnly').keypress(function(e) {

        var charCode = (e.which) ? e.which : event.keyCode
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which >
                57))
            return false;
    });
 function checkReg() {
        let reg = $('#reg').val();
	reg = reg.trim()

	if(reg == '') {
		$('#notok').text('')
        	$('#ok').text('')
		return
	}

        $.ajax({
            type: "get",
            url: "{{route('checkReg')}}",
            data: {
                sts:reg
            },
            dataType: "json",
            success: function (res) {
                $('#notok').text('')
                $('#ok').text('')
                if(res.status == 200)
                    $('#notok').text('Reg No Already Exist: ' + res.info)
                else
                    $('#ok').text('OK')
            }
        });
    }
</script>
