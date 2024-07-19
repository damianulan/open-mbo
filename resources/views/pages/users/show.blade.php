@extends('layouts.portal.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-10 col-sm-12">
            <div class="card profile-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-xs-6">
                            <div class="profile-picture p-2">
                                <img src="{{ $user->getAvatar() }}" width="100%">
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-9 col-md-8 col-xs-6">
                            <div class="user-header">
                                <div class="user-title">
                                    <div class="user-name">{{ $user->name() }}</div>
                                </div>
                                <div class="user-actions">
                                    <a href="{{ route('users.edit', $user->id) }}" class="" data-tippy-content="{{ __('buttons.edit') }}">
                                        <i class="bi-pencil-square"></i>
                                    </a>
                                    <a href="#" class="" data-tippy-content="{{ __('buttons.reset_password') }}">
                                        <i class="bi-key-fill"></i>
                                    </a>
                                    @if($user->active !== 1)
                                    <a href="{{ route('users.block', $user->id) }}" class="" data-tippy-content="{{ __('buttons.unblock') }}">
                                        <i class="bi-person-fill-check"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('users.block', $user->id) }}" class="swal-confirm" data-tippy-content="{{ __('buttons.block') }}" data-swal-text="{{ __('alerts.users.info.block') }}">
                                        <i class="bi-person-fill-lock"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('users.delete', $user->id) }}" class="swal-confirm" data-tippy-content="{{ __('buttons.delete') }}" data-swal-text="{{ __('alerts.users.info.delete') }}">
                                        <i class="bi-trash-fill"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row user-summary">
                                <div class="user-info col-xl-6 col-lg-12">
                                    <i class="bi bi-envelope-at-fill" data-tippy-content="Adres e-mail"></i><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </div>
                                <div class="user-info col-xl-6 col-lg-12">
                                    <i class="bi bi-building-fill" data-tippy-content="Przedsiębiorstwo"></i><div>OpenMBO LLP</div>
                                </div>
                                <div class="user-info col-xl-6 col-lg-12">
                                    <i class="bi bi-diagram-3-fill" data-tippy-content="Departament"></i><div>Departament menadżerski MBO</div>
                                </div>
                                <div class="user-info col-xl-6 col-lg-12">
                                    <i class="bi bi-person-badge-fill" data-tippy-content="Stanowisko"></i><div>Administrator przebiegów gospodarczo-produkcyjnych</div>
                                </div>
                                <div class="user-info col-xl-6 col-lg-12">
                                    <i class="bi bi-person-fill-gear" data-tippy-content="Role"></i><div>{{ $user->getRolesNames()->implode(', ') }}</div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-2 col-sm-12">

        </div>
    </div>
</div>


@endsection
@section('page-scripts')

@endsection
