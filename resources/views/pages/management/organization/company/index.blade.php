@extends('layouts.portal.master')
@section('content')

@include('pages.management.nav')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('management.organization.company.create') }}" data-tippy-content="{{ __('buttons.add') }}">
            <i class="bi-plus-circle-fill"></i>
        </a>
    </div>
</div>
<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-container row">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-scripts')
{{ $dataTable->scripts() }}
@endsection
