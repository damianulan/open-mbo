@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">
    @include('pages.campaigns.nav')

    <div class="row">
        @foreach ($campaigns as $campaign)
            <div class="col-md-4 card-col">
                @include('components.campaign-card')
            </div>
        @endforeach

    </div>
</div>

@endsection
@section('page-scripts')

@endsection
