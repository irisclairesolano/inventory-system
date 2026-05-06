@props(['type' => 'success', 'message' => null])

@php
    $classes = match($type) {
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning',
        default => 'alert-success',
    };
@endphp

<div class="alert {{ $classes }} flex items-center justify-between" x-data="{ open: true }" x-show="open">
    <span>{{ $message ?? $slot }}</span>
    <button @click="open = false" class="ml-4 font-bold hover:opacity-70">
        ✕
    </button>
</div>
