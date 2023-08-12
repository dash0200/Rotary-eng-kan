<x-main-card>
    States
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <div class="flex justify-around">
        <div class="w-1/4 border p-4">
            <form action="{{route('master.addState')}}" method="post">
                 <div>
                     <x-label value="State Name" />
                     <x-input type="text" name="state" />
                     <x-button-primary value="Add" />
                 </div>
            </form>
         </div>
     
         <div class="w-1/4 border p-4">
            <form action="{{route('master.addDist')}}" method="post">
                @csrf
                 <div>
                    <x-label value="Select State" />
                    <select name="state" id="state" required class="{{ $errors->has('state') ? 'is-invalid' : '' }}">
                     <option value="">Select State</option>
                     @foreach($states as $state)
                         <option value="{{ $state->id}}">{{$state->name}}</option>
                     @endforeach
                    </select>
                    <x-label value="District Name" />
                    <x-input type="text" name="dist" required class="{{ $errors->has('state') ? 'is-invalid' : '' }}"/>
                    <x-button-primary value="Add" />
                 </div>
            </form>
         </div>

         <div class="w-1/4 border p-4">
            <form action="{{route('master.addSub')}}" method="post">
                @csrf
                 <div>
                    <x-label value="Select District" />
                    <select name="dist" id="dist" required >
                     <option value="">Select District</option>
                     @foreach($dists as $dist)
                         <option value="{{ $dist->id}}">{{$dist->name}}</option>
                     @endforeach
                    </select>
                    <x-label value="Sub_District Name" />
                    <x-input type="text" name="sub" required />
                    <x-button-primary value="Add" />
                 </div>
            </form>
         </div>
    </div>
</x-main-card>

<script>
    $("#state").select2()
    $("#dist").select2()
</script>