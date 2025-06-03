<a class="action-btn" href="{{ route('mbo.objectives.show', $data->id) }}" title="{{ __('buttons.summary') }}">
    <i class="bi bi-eye-fill me-1"></i>
</a>
{{-- <a class="action-btn" href="{{ route('mbo.objectives.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square me-1"></i>
</a> --}}
@if($data->canBeDeleted())
<a class="action-btn swal-confirm" href="{{ route('mbo.objectives.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.objectives.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
@endif
