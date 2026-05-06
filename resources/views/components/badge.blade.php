@props(['status' => null, 'type' => null, 'label' => null])

@php
    // Support both 'status' and 'type' prop names for flexibility
    $badgeType = $type ?? $status ?? 'success';

    $badgeStyles = [
        'success' => 'badge-success',
        'warning' => 'badge-warning',
        'danger' => 'badge-danger',
        'in-stock' => 'badge-success',
        'low-stock' => 'badge-warning',
        'out-of-stock' => 'badge-danger',
    ];

    $class = $badgeStyles[$badgeType] ?? $badgeStyles['success'];
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ $label ?? $slot }}
</span>

