<x-main-card>
    Datewise
    <div class="w-full bg-gray-200" style="height: 1px;"></div> 

    <form action="{{route('general.datewiseGetReceipt')}}" method="post">
        @csrf
        <div class="flex justify-around">
            <div class="m-4">
                <x-label value="From Date"/>
                <x-input type="date" name="from" required/>
            </div>
            <div class="m-4">
                <x-label value="To Date"/>
                <x-input type="date" name="to" required />
            </div>
            <div class="m-4">
                <x-label value="Submit"/>
                <x-button-primary value="Submit"/>
            </div>
        </div>
    </form>
</x-main-card>