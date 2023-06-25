@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">

    <div class="row course">
        <div class="col-md-9">
            @include('pages.components.course.details')
        </div>
        <div class="col-md-3">
            @include('pages.components.course.resources')
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection