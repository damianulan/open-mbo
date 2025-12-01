<a class="action-btn" href="{{ route('objectives.show', $data->id) }}" title="{{ __('buttons.summary') }}">
    <i class="bi bi-eye-fill"></i>
</a>
@if($data->campaign)
    <a class="action-btn" href="{{ route('campaigns.show', $data->campaign->id) }}" title="{{ __('mbo.entities.campaign') }}">
        <i class="bi bi-bullseye"></i>
    </a>
@endif
<a class="action-btn" onclick="edit_objective('{{ $data->id }}')" href="javascript:void(0);"  title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square"></i>
</a>
<a class="action-btn" onclick="add_users('{{ $data->id }}')" href="javascript:void(0);" title="{{ __('buttons.add_users') }}">
    <i class="bi bi-person-fill-up"></i>
</a>
@if($data->canBeDeleted())
<a class="action-btn swal-confirm" href="{{ route('objectives.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.objectives.info.delete') }}">
    <i class="bi bi-trash-fill"></i>
</a>
@endif
