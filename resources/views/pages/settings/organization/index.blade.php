@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card pt-3">

    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.organization.companies.index') }}" link="{{ route('settings.organization.company.index') }}" icon="building-fill-gear"/>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.organization.departments.index') }}" link="#" icon="diagram-3-fill"/>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.organization.positions.index') }}" link="#" icon="person-badge-fill"/>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.teams.index') }}" link="#" icon="people-fill"/>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.organization.contracts.index') }}" link="#" icon="clipboard2-fill"/>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <x-tile-button title="{{ __('menus.settings.creator.index') }}" link="#" icon="sliders"/>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush
