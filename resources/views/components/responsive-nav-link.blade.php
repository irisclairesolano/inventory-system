@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#D3968C] text-start text-base font-medium text-[#0A3323] bg-[#F7F4D5] focus:outline-none focus:text-[#0A3323] focus:bg-[#E8E6C8] focus:border-[#D3968C] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#E8E6C8] hover:text-[#F7F4D5] hover:bg-[#839958] hover:border-[#D3968C] focus:outline-none focus:text-[#F7F4D5] focus:bg-[#839958] focus:border-[#D3968C] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
