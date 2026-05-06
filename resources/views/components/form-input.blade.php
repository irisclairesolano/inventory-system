@props(['label', 'name', 'type' => 'text', 'required' => false, 'value' => null, 'error' => null])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'input-field' . ($errors->has($name) ? ' border-red-500' : '')]) }}
    >
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
