<input type="{{ $element->type }}" class="{{ $classes ? $classes:'' }} @error($element->name) is-invalid @enderror"
id="id_{{ $element->name }}" name="{{ $element->name }}" autocomplete="off" value="{{ request()->old($element->name) ? date(config('app.'.$element->type.'_format'), strtotime(request()->old($element->name)) ):$element->value }}" placeholder="{{ $element->placeholder ? $element->placeholder:'' }}"
{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}
>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
