@extends('layouts.portal.master')
@section('content')

@include('pages.management.nav')

<nav class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('management.objectives.create') }}" data-tippy-content="{{ __('buttons.create_template') }}">
            <i class="bi-plus-circle-fill"></i>
        </a>
    </div>
</nav>
@if (count($objectives))
<div class="content-card">

    <div class="row">
        @foreach($objectives as $objective)
            <div class="col-md-4">
                @include('components.objective-card')
            </div>
        @endforeach
    </div>
</div>
@else
<x-nocontent-page/>
@endif


@endsection
@section('page-scripts')

@endsection
