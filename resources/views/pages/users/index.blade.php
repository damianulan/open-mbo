@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline-primary me-3" href="#"><i class="bi-plus-lg me-2"></i>Dodaj</a>
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