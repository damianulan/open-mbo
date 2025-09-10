<a class="action-btn" href="{{ route('settings.organization.company.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square me-1"></i>
</a>
<a class="action-btn swal-confirm" href="{{ route('settings.organization.company.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.companies.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
