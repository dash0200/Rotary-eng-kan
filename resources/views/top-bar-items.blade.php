<x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-jet-nav-link>

<x-drop :name="'Master'" :active="request()->routeIs('master.*')">
    <x-dropdown-link href="{{ route('master.feesHeads') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('master.feesHeads')">
        Fees Heads
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('master.feesDetails') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('master.feesDetails')">
        Feees Details
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('master.castDetails') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('master.castDetails')">
        Cast Details
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('master.states') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('master.states')">
        STATE-DIST-TAL
    </x-dropdown-link>
</x-drop>

<x-drop :name="'Transactions'" :active="request()->routeIs('trans.*')">
    <x-dropdown-link href="{{ route('trans.newAdmission') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('trans.newAdmission')">
        New Admission
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('trans.creatingClasses') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('trans.creatingClasses')">
        Creating Classes
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('trans.getStudentId') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('trans.getStudentId')">
        Get Student ID
    </x-dropdown-link>
</x-drop>

<x-drop :name="'Fees Details'" :active="request()->routeIs('fees.*')">
    <x-dropdown-link href="{{ route('fees.feesReceipts') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('fees.feesReceipts')">
        Fees Receipts
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.receiptCancellation') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('fees.receiptCancellation')">
        Receipts Cancellation
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.feesArrears') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('fees.feesArrears')">
        Fees Arrears
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.dayBook') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('fees.dayBook')">
        Day Book
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.feesRegister') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('fees.feesRegister')">
        Fees Register
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.receiptDatewise') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('fees.receiptDatewise')">
        Receipt Datewise
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('fees.duplicateReceipt') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('fees.duplicateReceipt')">
        Duplicate Receipt
    </x-dropdown-link>
</x-drop>

<x-drop :name="'Reports'" :active="request()->routeIs('report.*')">

    <x-dropdown-link href="{{ route('report.castDetails') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('report.castDetails')">
        Cast Details
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('report.feesStructure') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('report.feesStructure')">
        Fees Structure
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('report.generalRegister') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('report.generalRegister')">
        General Register
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('report.classDetails') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('report.classDetails')">
        Class Details
    </x-dropdown-link>
</x-drop>

<x-drop :name="'Certificates'" :active="request()->routeIs('certificate.*') || request()->routeIs('trans.*')">

    <x-dropdown-link href="{{ route('certificate.certificate') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('certificate.certificate')">
        Certificate
    </x-dropdown-link>
    <x-dropdown-link href="{{ route('trans.leavingCertificate') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('trans.leavingCertificate')">
        Leaving Certificate
    </x-dropdown-link>

    <x-dropdown-link href="{{route('trans.searchLC')}}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('trans.searchLC')">
        Search LC
    </x-dropdown-link>
</x-drop>

{{-- <x-drop :name="'Building Fund'" :active="request()->routeIs('building.*')">

    <x-dropdown-link href="{{route('building.receipt')}}" class="border-b border-b-indigo-200" :active="request()->routeIs('building.receipt')">
       Building Fund Receipt
    </x-dropdown-link>

    <x-dropdown-link href="{{route('building.duplicateReceipt')}}" class="border-b border-b-indigo-200" :active="request()->routeIs('building.duplicateReceipt')">
       Building Duplicate Receipt
    </x-dropdown-link>

    <x-dropdown-link href="{{route('building.dailyReport')}}" class="border-b border-b-indigo-200" :active="request()->routeIs('building.dailyReport')">
       Daily Report
    </x-dropdown-link>

    <x-dropdown-link href="{{route('building.report')}}" class="border-b border-b-indigo-200" :active="request()->routeIs('building.report')">
       Building Fund Report
    </x-dropdown-link>

    <x-dropdown-link href="{{route('building.receiptDeletion')}}" class="border-b border-b-indigo-200" :active="request()->routeIs('building.receiptDeletion')">
       Building Fund Receipt Deletion
    </x-dropdown-link>
    
</x-drop> --}}

<x-drop :name="'General Receipts'" :active="request()->routeIs('general.*')">

    <x-dropdown-link href="{{ route('general.generalReceipts') }}" class="border-b border-b-indigo-200"
        :active="request()->routeIs('general.generalReceipts')">
        General Receipts
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('general.dayBook') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('general.dayBook')">
        Day Book
    </x-dropdown-link>

    <x-dropdown-link href="{{ route('general.datewise') }}" class="border-b border-b-indigo-200" :active="request()->routeIs('general.datewise')">
        Datewise
    </x-dropdown-link>

</x-drop>
