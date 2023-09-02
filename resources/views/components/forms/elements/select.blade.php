<select id="id_{{ $element->name }}" class="{{ $classes ? $classes:'' }} @error($element->name) is-invalid @enderror"
name="{{ $element->name }}{{ $element->multiple ? '[]':'' }}"{{ $element->placeholder ? ' data-placeholder="'.$element->placeholder.'"':'' }}
{{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}{{ $element->multiple ? ' multiple':'' }}>
@if($element->multiple === false && $element->empty_field)
<option></option>
@endif
@if (!empty($element->options))
    @foreach ($element->options as $option)
        <option value="{{ $option->value }}"
            @if(request()->old($element->name) && ( $option->value == request()->old($element->name) || in_array($option->value, request()->old($element->name)) ))
                selected
            @elseif(in_array($option->value,$element->values))
                selected
            @endif
            >{{ $option->content }}</option>
    @endforeach
@endif
</select>
@error($element->name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
