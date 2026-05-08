@props(['type' => 'success', 'message' => null])

@php

$base = 'mb-6 px-4 py-2.5 rounded-lg text-sm font-medium border flex items-start justify-between gap-4 shadow-sm';

$styles = match($type) {
    'success' => 'bg-[#839958]/20 border-[#839958] text-[#F7F4D5]',
    'danger' => 'bg-red-500/20 border-red-500 text-[#F7F4D5]',
    'warning' => 'bg-[#D3968C]/20 border-[#D3968C] text-[#F7F4D5]',
    default => 'bg-[#839958]/20 border-[#839958] text-[#F7F4D5]',
};
@endphp

<div 
    x-data="{ open: true }" 
    x-show="open"
    class="{{ $base }} {{ $styles }}"
>
    <span class="leading-snug">
        {{ $message ?? $slot }}
    </span>

    <button 
        @click="open = false"
        class="text-[#F7F4D5]/70 hover:text-[#F7F4D5] transition"
    >
        ✕
    </button>
</div>