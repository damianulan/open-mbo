<a class="action-btn" href="{{ route('settings.organization.departments.edit', $data) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square"></i>
</a>
<a class="action-btn swal-confirm" href="{{ route('settings.organization.departments.delete', $data) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.departments.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
