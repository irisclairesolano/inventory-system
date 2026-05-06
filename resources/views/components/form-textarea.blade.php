@props(['label', 'name', 'required' => false, 'rows' => 4])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'input-field' . ($errors->has($name) ? ' border-red-500' : '')]) }}
    >{{ old($name) }}</textarea>
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
