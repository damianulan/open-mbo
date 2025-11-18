<a class="action-btn" href="{{ route('categories.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square"></i>
</a>
@if($data->canBeDeleted())
<a class="action-btn swal-confirm" href="{{ route('categories.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.objective_categories.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
@endif
