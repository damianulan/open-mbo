@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="container">
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