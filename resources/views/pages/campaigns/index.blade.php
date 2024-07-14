@extends('layouts.portal.master')
@section('content')

@include('pages.campaigns.nav')

@if (count($campaigns))
<div class="content-card">

    <div class="row">
        @foreach ($campaigns as $campaign)
            <div class="col-md-4 card-col">
                @include('components.campaign-card')
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
