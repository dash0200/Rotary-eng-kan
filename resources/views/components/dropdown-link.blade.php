@props([
    "active" => ''
])

@php

$classes = "";

// if($active) {
//     $classes = "block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition bg-blue-100";
// } else {
//     $classes = "block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition";
// }

$classes = ($active) ? 
            "block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 
             focus:outline-none focus:bg-gray-100 transition bg-blue-100"
             :
            "block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 
             focus:outline-none focus:bg-gray-100 transition";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>