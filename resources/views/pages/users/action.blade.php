@can('edit', $data)
    <a class="action-btn" href="{{ route('users.edit', $data->id) }}" title="{{ __('buttons.edit') }}">
        <i class="bi bi-pencil-square"></i>
    </a>
@endcan

@can ('block', $data)
    @if($data->suspended_at !== null)
        <a class="action-btn" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.unblock') }}">
            <i class="bi bi-person-fill-check"></i>
        </a>
    @else
        <a class="action-btn swal-confirm" href="{{ route('users.block', $data->id) }}" title="{{ __('buttons.block') }}" data-swal-text="{{ __('alerts.users.info.block') }}">
            <i class="bi bi-person-fill-lock"></i>
        </a>
    @endif
@endcan

@can('delete', $data)
    <a class="action-btn swal-confirm" href="{{ route('users.delete', $data->id) }}" title="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.users.info.delete') }}">
        <i class="bi bi-trash-fill"></i>
    </a>
@endcan
@if ($data->canBeImpersonated())
    <a class="action-btn" href="{{ route('users.impersonate', $data->id) }}" title="{{ __('buttons.impersonate') }}">
        <i class="bi bi-person-fill-up"></i>
    </a>
@endif
