@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('users.create') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.add') }}">
            <i class="bi-plus-circle-fill"></i>
        </a>
        <a class="icon-btn" href="#" data-bs-toggle="tooltip" data-bs-title="Zespoły">
            <i class="bi-people-fill"></i>
        </a>
    </div>
</div>
<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-container">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>


@endsection
@section('page-scripts')
{{ $dataTable->scripts() }}
@endsection
