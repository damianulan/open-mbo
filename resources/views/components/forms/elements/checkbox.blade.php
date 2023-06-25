<div class="form-check{{ $element->type === 'switch' ? ' form-switch':'' }}@error($element->name) is-invalid @enderror">
    <input type="hidden" name="{{ $element->name }}" value="off">
    <input class="form-check-input" type="{{ $element->type === 'radio' ? 'radio':'checkbox' }}" {{ $element->type === 'switch' ? 'role=switch':'' }}
    id="id_{{ $element->name }}" name="{{ $element->name }}"{{ $element->checked ? ' checked':'' }}{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}
    >
</div>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
