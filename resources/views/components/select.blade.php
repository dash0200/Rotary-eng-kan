@props(['options'])

{{-- @php
$options = [1 => 'one', 2 => 'two', 3 => 'three'];
@endphp --}}

<select {!! $attributes->merge(['class' => '']) !!}>
    {{$slot}}
</select>