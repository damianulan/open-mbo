@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
@include('pages.management.nav')

<div class="container-fluid">
    <div class="icon-btn-nav">
        <div class="panel-left">
            <a class="icon-btn" href="{{ route('management.objectives.create') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.create_template') }}">
                <i class="bi-plus-circle-fill"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($objectives as $objective)
            <div class="col-md-4">
                @include('components.objective-card')
            </div>
        @endforeach
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
