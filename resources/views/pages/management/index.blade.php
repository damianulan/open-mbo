@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
@include('pages.management.nav')

<div class="container-fluid">
    <div class="icon-btn-nav">
        <div class="panel-left">
            <a class="icon-btn" href="#" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.add') }}"><i class="bi-plus-circle-fill"></i></a>
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
