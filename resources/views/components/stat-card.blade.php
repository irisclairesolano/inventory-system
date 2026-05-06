@props(['icon' => '📊', 'title' => '', 'value' => '0', 'subtitle' => null, 'bgColor' => 'bg-primary-50', 'textColor' => 'text-primary-600'])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg p-6 shadow-sm']) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $value }}</p>
            @if($subtitle)
                <p class="text-xs text-gray-500 mt-2">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="{{ $bgColor }} {{ $textColor }} text-3xl w-16 h-16 rounded-lg flex items-center justify-center">
            {{ $icon }}
        </div>
    </div>
</div>
