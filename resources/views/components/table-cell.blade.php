@props([])

<td {{ $attributes->merge(['class' => 'px-6 py-4 text-sm font-medium text-gray-700 border-b border-gray-100 first:text-left']) }}>
    {{ $slot }}
</td>
