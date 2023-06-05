@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
@include('pages.settings.nav')

<div class="container settings">
    <div class="section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h5 class="section-title">{{ __('pages.settings.modules') }}</h5>
                <hr/>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
    <div class="section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h5 class="section-title">{{ __('pages.settings.branding') }}</h5>
                <hr/>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection