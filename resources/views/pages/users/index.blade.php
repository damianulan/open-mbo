@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline-primary me-2" href="{{ route('users.create') }}"><i class="bi-plus-lg me-2"></i>{{ __('buttons.add') }}</a>
            <a class="btn btn-outline-primary me-2" href="#"><i class="bi-people-fill me-2"></i>Zespoły</a>
        </div>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>


@endsection
@section('page-scripts')
{{ $dataTable->scripts() }}
@endsection
