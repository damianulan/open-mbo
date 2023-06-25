<x-forms.elements.trix-field id="id_{{ $element->name }}" name="{{ $element->name }}" toolbar="{{ $element->toolbar }}" value="{{ request()->old($element->name) ?? $element->value }}" />
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
