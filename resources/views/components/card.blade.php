@props(['title' => null, 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-150']) }}>
    @if($title)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            @if($subtitle)
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
