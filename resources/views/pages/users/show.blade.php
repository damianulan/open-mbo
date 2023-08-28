@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
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
                                    <div class="user-position">Administrator danych osobowych</div>
                                </div>
                                <div class="user-actions">
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.favourities_add') }}">
                                        <i class="bi-star"></i>
                                    </a>
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.edit') }}">
                                        <i class="bi-pencil-square"></i>
                                    </a>
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.reset_password') }}">
                                        <i class="bi-key-fill"></i>
                                    </a>
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.block') }}">
                                        <i class="bi-person-fill-lock"></i>
                                    </a>
                                    <a href="#" class="" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.delete') }}">
                                        <i class="bi-trash-fill"></i>
                                    </a>
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
