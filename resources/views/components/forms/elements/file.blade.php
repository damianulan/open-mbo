<div class="input-group">
    <label class="input-group-text" for="id{{ $element->name }}">{{ __('buttons.choose_file') }}</label>
    <input type="file" class="{{ $classes ? $classes:'' }}@error($element->name) is-invalid @enderror" id="id_{{ $element->name }}"
    name="{{ $element->name }}" accept="{{ $element->getExt() }}"
    {{ $element->required ? ' required':'' }}{{ $element->readonly ? ' readonly':'' }}{{ $element->disabled ? ' disabled':'' }}{{ $element->multiple ? ' multiple':'' }}
    >
    @error($element->name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    @if($element->hasValue)
    <div class="input-snippet text-muted">
        Wybierając nadpiszesz istniejący już plik.
    </div>
    @endif
</div>
