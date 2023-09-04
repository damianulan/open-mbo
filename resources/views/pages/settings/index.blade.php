@extends('layouts.portal.master')
@section('content')

@include('pages.settings.nav')
@include('layouts.components.alerts')

<div class="content-card">
    <div class="container settings">
        <div class="section">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="section-title">{{ __('pages.settings.general') }}</h5>
                    <hr/>
                </div>
                <div class="col-md-8 settings-contents">
                    <div class="row">
                        {{ $form->render() }}
                    </div>

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
</div>


@endsection
@section('page-scripts')

@endsection
