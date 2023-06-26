<input type="{{ $element->type }}" class="{{ $classes ? $classes:'' }} @error($element->name) is-invalid @enderror"
id="id_{{ $element->name }}" name="{{ $element->name }}" value="2023-06-20"{{ $element->placeholder ? ' placeholder='.$element->placeholder:'' }}
{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}
>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
