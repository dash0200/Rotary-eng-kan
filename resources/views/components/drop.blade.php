@props([
    'name' => "",
    "active" => "",
])

@php
$classes = "";

// if($active == true) {
//     $classes = "hidden sm:flex sm:items-center sm:ml-0 border-b-2 border-b-blue-500";
// }else{
//     $classes = "hidden sm:flex sm:items-center sm:ml-0";
// }

$classes = ($active) ? "hidden sm:flex sm:items-center sm:ml-0 border-b-2 border-b-indigo-400" : "hidden sm:flex sm:items-center sm:ml-0";

@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <div class="ml-3 relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                    {{$name}}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
        </x-slot> 

            <x-slot name="content">
                {{$slot}}
            </x-slot>
        </x-dropdown>
    </div>
</div>