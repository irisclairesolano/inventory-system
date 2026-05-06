@props(['label', 'name', 'options' => [], 'required' => false, 'error' => null, 'placeholder' => '-- Select --'])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'input-field' . ($errors->has($name) ? ' border-red-500' : '')]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}" @if(old($name) == $value) selected @endif>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
