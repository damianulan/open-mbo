<a class="action-btn" href="{{ route('users.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
    <i class="bi bi-pencil-square me-1"></i>
</a>
@if ($data->canBeSuspended())
    @if($data->active !== 1)
        <a class="action-btn" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.unblock') }}">
            <i class="bi bi-person-fill-check me-1"></i>
        </a>
    @else
        <a class="action-btn swal-confirm" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.block') }}" data-swal-text="{{ __('alerts.users.info.block') }}">
            <i class="bi bi-person-fill-lock me-1"></i>
        </a>
    @endif
@endif

@if ($data->canBeDeleted())
    <a class="action-btn swal-confirm" href="{{ route('users.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.users.info.delete') }}">
        <i class="bi bi-trash-fill"></i>
    </a>
@endif
@can('users-impersonate')
    @if ($data->canBeImpersonated())
        <a class="action-btn" href="{{ route('users.impersonate', $data->id) }}" title="{{ __('buttons.impersonate') }}">
            <i class="bi bi-person-fill-up me-1"></i>
        </a>
    @endif
@endcan
