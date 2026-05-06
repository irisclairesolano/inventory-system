@props(['striped' => false])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg overflow-hidden']) }}>
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
