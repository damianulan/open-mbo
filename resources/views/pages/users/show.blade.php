@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-right">
        <x-user-banner :user="$user" />
    </div>
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('users.edit', $user->id) }}" class="" data-tippy-content="{{ __('buttons.edit') }}">
            <i class="bi-pencil-square"></i>
        </a>
        <a class="icon-btn" href="#" data-tippy-content="{{ __('buttons.favourites_add') }}">
            <i class="bi-star"></i>
        </a>
        <a class="icon-btn" href="#" class="" data-tippy-content="{{ __('buttons.reset_password') }}">
            <i class="bi-key-fill"></i>
        </a>
        @if($user->active !== 1)
            <a class="icon-btn" href="{{ route('users.block', $user->id) }}" class="" data-tippy-content="{{ __('buttons.unblock') }}">
                <i class="bi-person-fill-check"></i>
            </a>
        @else
        <a class="icon-btn swal-confirm" href="{{ route('users.block', $user->id) }}" data-tippy-content="{{ __('buttons.block') }}" data-swal-text="{{ __('alerts.users.info.block') }}">
            <i class="bi-person-fill-lock"></i>
        </a>
        @endif
        @can('users-impersonate')
            @if ($user->canBeImpersonated())
                <a class="icon-btn" href="{{ route('users.impersonate', $user->id) }}" data-tippy-content="{{ __('buttons.impersonate') }}">
                    <i class="bi-person-fill-up"></i>
                </a>
            @endif
        @endcan

        <a class="icon-btn swal-confirm" href="{{ route('users.delete', $user->id) }}" data-tippy-content="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.users.info.delete') }}">
            <i class="bi-trash-fill"></i>
        </a>
    </div>
</div>
@if($user->employment)
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-10 col-xs-12">
            <div class="row user-summary">
                <div class="user-info col-xl-6 col-lg-12">
                    <i class="bi bi-building-fill" data-tippy-content="{{ __('forms.employments.company') }}"></i><div>{{ $user->employment?->company?->name }}</div>
                </div>
                <div class="user-info col-xl-6 col-lg-12">
                    <i class="bi bi-diagram-3-fill" data-tippy-content="{{ __('forms.employments.department') }}"></i><div>{{ $user->employment?->department?->name }}</div>
                </div>
                <div class="user-info col-xl-6 col-lg-12">
                    <i class="bi bi-person-badge-fill" data-tippy-content="{{ __('forms.employments.position') }}"></i><div>{{ $user->employment?->position?->name }}</div>
                </div>
                <div class="user-info col-xl-6 col-lg-12">
                    <i class="bi bi-person-fill-gear" data-tippy-content="{{ __('forms.users.roles_short') }}"></i><div>{{ $user->getRolesNames()->implode(' | ') }}</div>
                </div>
            </div>

        </div>
    </div>
@endif
<div class="row">
    <div class="col-12">
        <x-note-card :subject="$user" />
    </div>
</div>


@endsection
@push('scripts')

@endpush
