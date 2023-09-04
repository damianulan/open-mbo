@extends('layouts.portal.master')
@section('content')

@include('pages.campaigns.nav')
@include('layouts.components.alerts')

<div class="content-card">

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
