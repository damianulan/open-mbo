<a class="action-btn" href="{{ route('settings.organization.contracts.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square"></i>
</a>
<a class="action-btn swal-confirm" href="{{ route('settings.organization.contracts.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.contracts.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>

