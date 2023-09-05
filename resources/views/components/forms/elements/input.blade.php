<input type="{{ $element->type }}" class="{{ $classes ? $classes:'' }}@error($element->name) is-invalid @enderror"
id="id_{{ $element->name }}" name="{{ $element->name }}" value="{{ $element->value ?? '' }}"  placeholder="{{ $element->placeholder ? $element->placeholder:'' }}"
{{ $element->maxlength ? ' maxlength="'.$element->maxlength.'"':'' }}{{ $element->minlength ? ' minlength="'.$element->minlength.'"':'' }}{{ !empty($element->autocomplete) ? ' autocomplete="'.$element->autocomplete."'":'' }}
{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}{{ $element->numeric ? ' data-validation=numeric':'' }}
>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
