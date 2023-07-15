@extends('layouts.portal.master')
@section('content')

@include('pages.courses.nav')
<div class="container-fluid">
    @include('layouts.components.alerts')

    @include('pages.components.course.action-menu')
    @include('pages.courses.'.$type)
</div>

@endsection
@section('page-scripts')
    @if($type === 'list-view' && isset($dataTable))
        {{ $dataTable->scripts() }}
    @endif
@endsection
