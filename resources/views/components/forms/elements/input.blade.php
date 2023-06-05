<input type="{{ $element->type }}" class="form-control{{ $classes ? ' class="'.$classes.'"':''  }}@error($element->name) is-invalid @enderror" 
id="id_{{ $element->name }}" name="{{ $element->name }}" value="{{ request()->old($element->name) ?? $element->value }}"{{ $element->placeholder ? ' placeholder="'.$element->placeholder.'"':'' }}
{{ $element->maxlength ? ' maxlength="'.$element->maxlength.'"':'' }}{{ $element->minlength ? ' minlength="'.$element->minlength.'"':'' }}
{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}
>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror