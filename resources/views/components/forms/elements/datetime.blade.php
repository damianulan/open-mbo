<input type="{{ $element->type }}" class="{{ $classes ? $classes:'' }} @error($element->name) is-invalid @enderror"
id="id_{{ $element->name }}" name="{{ $element->name }}" autocomplete="off" value="{{ $element->value ?? '' }}" placeholder="{{ $element->placeholder ? $element->placeholder:'' }}"
{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}
>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
