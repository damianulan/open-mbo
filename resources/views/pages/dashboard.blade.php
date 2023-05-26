@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('pages.components.dashboard')
        </div>
    </div>
</div>

@endsection
@section('page-scripts')
@endsection