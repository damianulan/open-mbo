<a class="action-btn" href="{{ route('settings.organization.team.edit', $data) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square"></i>
</a>
<a class="action-btn swal-confirm" href="{{ route('settings.organization.team.delete', $data) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.teams.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
