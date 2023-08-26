@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">
    @include('pages.campaigns.nav')

    <div class="row">
        <div class="col-md-4">
            @include('components.campaign-card')
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
