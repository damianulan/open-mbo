@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card pt-3">

    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="{{ route('management.organization.company.index') }}" class="btn-tile">
                <i class="bi bi-building-fill-gear"></i><span>{{ __('menus.management.organization.company.index') }}</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="#" class="btn-tile">
                <i class="bi bi-diagram-3-fill"></i><span>Departamenty</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="#" class="btn-tile">
                <i class="bi bi-person-badge-fill"></i><span>Stanowiska</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="#" class="btn-tile">
                <i class="bi bi-people-fill"></i><span>Zespoły</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="#" class="btn-tile">
                <i class="bi bi-clipboard2-fill"></i><span>Typy kontraktów</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12 pt-4">
            <a href="#" class="btn-tile">
                <i class="bi bi-sliders"></i><span>Kreator struktury</span><i class="bi bi-arrow-right on-hover"></i>
            </a>
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
