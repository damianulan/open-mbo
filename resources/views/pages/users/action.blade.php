<a class="action-btn" href="{{ route('users.show', $data->id) }}" title="{{ __('buttons.profile_show') }}">
    <i class="bi bi-person-badge me-1"></i>
</a>
<a class="action-btn" href="{{ route('users.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square me-1"></i>
</a>
@if($data->active == 1)
    <a class="action-btn" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.unblock') }}">
        <i class="bi bi-person-fill-check me-1"></i>
    </a>
@else
    <a class="action-btn" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.block') }}">
        <i class="bi bi-person-fill-lock me-1"></i>
    </a>
@endif

<a class="action-btn swal-confirm" href="{{ route('users.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="Usunięcie użytkownika będzie nieodwracalne.">
    <i class="bi bi-trash-fill"></i>
</a>
