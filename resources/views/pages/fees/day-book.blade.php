<x-main-card>
    Day Book
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <form action="{{route('fees.daybookSubmit')}}">
        <div class="flex justify-center items-center space-x-11">
            <div>
                <select name="section" id="section">
                    <option value="1">PRIMARY</option>
                    <option value="2">HIGHER</option>
                </select>
            </div>
        
            <div>
                <x-input type="date" name="date" id="date"/>
            </div>
            <div>
                <x-button-primary value="submit" />
            </div>
        </div>
    </form>
</x-main-card>

<script>
    $("#section").select2();
</script>