<x-main-card>

    Receipts of <b>{{ucfirst($student->name)." ".ucfirst($student->fname)." ".ucfirst($student->lname)}}</b>
    <div class="w-full bg-gray-200" style="height: 1px;"></div>

    <x-table>
            <x-thead>
                <x-th>
                   Receipt Amount
                </x-th>
                <x-th>
                    Receipt No
                </x-th>
                <x-th>
                    For the Academic Year
                </x-th>
                <x-th>
                    For the Class
                </x-th>
                <x-th>
                    Receipt Date
                </x-th>
                <x-th>
                    
                </x-th>
            </x-thead>
            
            <tbody id="byId">
                @forelse($receipts as $receipt)
                <tr>
                    <x-td>
                       {{$receipt->amt_paid}}
                    </x-td>
                    <x-td>
                        {{$receipt->receipt_no}}
                    </x-td>
                    <x-td>
                        {{$receipt->year}}
                    </x-td>
                    <x-td>
                        {{$receipt->class==null?'':$receipt->class}}
                    </x-td>
                    <x-td>
                        {{$receipt->created_at->format("d-m-Y")}}
                    </x-td>
                    <x-td>
                        <a href="{{route('fees.getDuplicate', ["id" => $receipt->id])}}">
                            <x-button-primary value="get duplicate receipt" />
                        </a>
                    </x-td>
                    </tr>
                @empty
                    <tr>
                        <x-td colspan="">
                            No Receipts Found
                        </x-td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    
</x-main-card>