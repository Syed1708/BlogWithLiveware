@props(['textColor', 'bgColor', 'hoverColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-800',
        'red' => 'text-red-800',
        'green' => 'text-green-800',
        'pink' => 'text-pink-800',
        default => 'text-gray-800',
        
    };

    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-100',
        'red' => 'bg-red-100',
        'green' => 'bg-green-100',
        'pink' => 'bg-pink-100',
        default => 'bg-gray-100',
        
    };
    // $hoverColor = match ($hoverColor) {
    //     'gray' => 'text-gray-900',
    //     'red' => 'text-red-900',
    //     'green' => 'text-green-900',
    //     'pink' => 'text-pink-900',
    //     default => 'text-gray-900',
        
    // }
@endphp


<button {{$attributes}}  class="{{$textColor}} {{$bgColor}} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>
