@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-right">
        <x-user-banner :user="$user" />
    </div>
    <div class="panel-left">
        <a class="icon-btn ms-2" href="#" class="" data-tippy-content="{{ __('forms.mbo.objectives.award') }}">
            <i class="bi-award"></i>
            <span>{{ $user->points }}</span>
        </a>
        @if(auth()->user()->canImpersonate($user))
            @if ($user->canBeImpersonated())
                <a class="icon-btn" href="{{ route('users.impersonate', $user->id) }}" data-tippy-content="{{ __('buttons.impersonate') }}">
                    <i class="bi-person-fill-up"></i>
                </a>
            @endif
        @endif
        @can('edit', $user)
            <a class="icon-btn" href="{{ route('users.edit', $user->id) }}" class="" data-tippy-content="{{ __('buttons.edit') }}">
                <i class="bi-pencil-square"></i>
            </a>
        @endcan

        @if(auth()->user()->favourite_users->contains($user))
            <a class="icon-btn" href="{{ route('users.favourite', $user) }}" data-tippy-content="{{ __('buttons.favourites_remove') }}">
                <i class="bi-star-fill"></i>
            </a>
        @else
            <a class="icon-btn" href="{{ route('users.favourite', $user) }}" data-tippy-content="{{ __('buttons.favourites_add') }}">
                <i class="bi-star"></i>
            </a>
        @endif
        @can('reset', $user)
            <a class="icon-btn" href="{{ route('users.reset_password', $user) }}" class="" data-tippy-content="{{ __('buttons.reset_password') }}">
                <i class="bi-key-fill"></i>
            </a>
        @endcan
        @can('block', $user)
            @if($user->suspended_at !== null)
                <a class="icon-btn" href="{{ route('users.block', $user->id) }}" class="" data-tippy-content="{{ __('buttons.unblock') }}">
                    <i class="bi-person-fill-check"></i>
                </a>
            @else
            <a class="icon-btn swal-confirm" href="{{ route('users.block', $user->id) }}" data-tippy-content="{{ __('buttons.block') }}" data-swal-text="{{ __('alerts.users.info.block') }}">
                <i class="bi-person-fill-lock"></i>
            </a>
            @endif
        @endcan

        @can('delete', $user)
            <a class="icon-btn swal-confirm" href="{{ route('users.delete', $user->id) }}" data-tippy-content="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.users.info.delete') }}">
                <i class="bi-trash-fill"></i>
            </a>
        @endcan
    </div>
</div>
@if($user->employment)
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-md-10 col-xs-12">
            <div class="user-summary">
                @if ($company = $user->employment?->company?->name ?? null)
                    <div class="user-info">
                        <i class="bi bi-building-fill" data-tippy-content="{{ __('forms.employments.company') }}"></i><div>{{ $company }}</div>
                    </div>
                @endif
                @if ($department = $user->employment?->department?->name ?? null)
                    <div class="user-info">
                        <i class="bi bi-diagram-3-fill" data-tippy-content="{{ __('forms.employments.department') }}"></i><div>{{ $department }}</div>
                    </div>
                @endif
                @if ($position = $user->employment?->position?->name ?? null)
                    <div class="user-info">
                        <i class="bi bi-person-badge-fill" data-tippy-content="{{ __('forms.employments.position') }}"></i><div>{{ $position }}</div>
                    </div>
                @endif
                @if ($contract = $user->employment?->contract?->name ?? null)
                    <div class="user-info">
                        <i class="bi bi-journal-text" data-tippy-content="{{ __('forms.employments.contract') }}"></i><div>{{ $contract }}</div>
                    </div>
                @endif
                <div class="user-info">
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
