<x-main-card>
    
    <div class="flex justify-center w-full">
        <div class="flex flex-col items-center pb-10">
            <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{asset('logo.png')}}" alt="Bonnie image">
            <span>Total Students Registered at this school</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$students}}</h5>
        </div>
    </div>

<div class="flex flex-col">
    <div>
        <h2>New Admissions this year</h2>: {{$newAdmission}}
    </div>
    <div>
        Academic Year - <b>{{$year}}</b> - Total Students Classes wise
    </div>
    <div class="flex justify-around flex-wrap mt-10">
        <div class="flex flex-col items-center pb-10">
    
            <span class="uppercase">nursery</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$nursery}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">lkg</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$lkg}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">ukg</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$ukg}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">first</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$first}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">second</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$second}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">third</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$third}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">fourth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$fourth}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">fifth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$fifth}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">sixth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$sixth}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">seventh</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$seventh}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">eighth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$eighth}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">nineth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$nineth}}</h5>
        </div>
        <div class="flex flex-col items-center pb-10">
           
            <span class="uppercase">tenth</span>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$tenth}}</h5>
        </div>
    </div>

    <div class="flex flex-col items-center">
        <div>Total Students for the Academic Year : <b>{{$year}}</b></div>

        <div class="flex justify-center font-bold">
            {{$totalStudentThisYear}}   
        </div>
    </div>
</div>

</x-main-card>
