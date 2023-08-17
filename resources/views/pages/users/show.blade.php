@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="profile-picture p-2">
                        <img src="{{ asset('images/portrait/avatar-male.png'); }}" width="100%">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="user-header">
                        <div class="user-name">{{ $user->name() }}</div>
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


@endsection
@section('page-scripts')

@endsection
