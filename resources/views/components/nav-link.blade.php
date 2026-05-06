@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#D3968C] text-sm font-medium leading-5 text-[#F7F4D5] focus:outline-none focus:border-[#D3968C] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#E8E6C8] hover:text-[#F7F4D5] hover:border-[#839958] focus:outline-none focus:text-[#F7F4D5] focus:border-[#839958] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
