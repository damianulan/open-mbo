@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card">
    <div class="container settings">
        <div class="section">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <h4 class="section-title">{{ __('Ustawienia aplikacji') }}</h4>
                    <hr/>
                </div>
                <div class="col-md-10 settings-contents">
                    <div class="row">
                        {{ $form->render() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <h4 class="section-title">{{ __('pages.settings.branding') }}</h5>
                    <hr/>
                </div>
            </div>
            <div class="row">
                <x-unavailable-page/>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

@endpush
