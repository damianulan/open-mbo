@extends('layouts.portal.master')
@section('content')

@include('pages.courses.nav')
<div class="container-fluid">
    @include('layouts.components.alerts')

    <div class="row course-card">
        @foreach($courses as $course)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-4">
            <x-course-card id="{{ $course->id }}" title="{{ $course->title }}" descr="{{ $course->description->stripFormat() }}" picture="{{ $course->loadPicture() }}" category="{{ $course->category->title }}" available_from="{{ $course->available_from }}" />
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
