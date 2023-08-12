<x-main-card>
    General Receipts
    <div class="w-full bg-gray-200" style="height: 1px;"></div>
    <form action="{{route('general.receipt')}}" method="post">
        @csrf
        <div class="flex justify-around items-center">
            <div class="m-2">
                <x-label value="Receipt Date" />
                <x-input type="date" required value="{{ date('Y-m-d') }}" name="date" />
            </div>
            <div class="m-2">
                <x-label value="Receipt Amount" />
                <x-input type="number" required name="amount" />
            </div>
            <div class="m-2">
                <x-label value="Financial Year" />
                <select required name="year" id="year">
                    <option value="">Financial Year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-center items-center">
            <div class="m-2 w-1/2">
                <x-label value="Receipt for the cause." />
                <x-input type="text" name="cause" placeholder="Receipt for the cause" />
            </div>
            <div class="mt-4 ml-4">
                <x-label value="" />
                <x-button-primary value="Submit" />
            </div>
        </div>
    </form>
</x-main-card>

<script>
    $("#year").select2()
</script>
