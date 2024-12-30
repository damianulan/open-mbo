@extends('layouts.portal.master')
@section('content')

@include('pages.mbo.campaigns.nav')

@if (count($campaigns))
<div class="content-card">

    <div class="row pagination-row">
        <div class="col-md-12">
            {{ $campaigns->links() }}
        </div>
    </div>
    <div class="row">
        @foreach ($campaigns as $campaign)
            <div class="col-md-4 card-col">
                @include('components.mbo.campaign-card')
            </div>
        @endforeach

    </div>
    <div class="row pagination-row">
        <div class="col-md-12">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>
@else
<x-nocontent-page/>
@endif


@endsection
@section('page-scripts')

@endsection
