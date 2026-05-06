@props([])

<th {{ $attributes->merge(['class' => 'px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-gray-50']) }}>
    {{ $slot }}
</th>
