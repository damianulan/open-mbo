<a href="{{ route('courses.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-fill me-1"></i>
</a>
@if($data->visible == 1)
<a href="{{ route('courses.hide', $data->id) }}" title="{{ __('buttons.hide') }}">
    <i class="bi bi-eye-slash-fill me-1"></i>
</a>
@else
<a href="{{ route('courses.hide', $data->id) }}" title="{{ __('buttons.unhide') }}">
    <i class="bi bi-eye-fill me-1"></i>
</a>
@endif
<a href="{{ route('courses.destroy', $data->id) }}" title="{{ __('buttons.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
