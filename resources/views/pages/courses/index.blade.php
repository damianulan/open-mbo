@extends('layouts.portal.master')
@section('content')

@include('pages.courses.nav')
<div class="container-fluid">
    @include('layouts.components.alerts')

    <div class="row course-card">
        @foreach($courses as $course)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-4">
            {{ $course->renderCard() }}
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
