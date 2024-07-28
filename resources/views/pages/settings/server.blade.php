@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card">
    <div class="container settings">
        <div class="section">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="section-title">{{ __('pages.settings.server_info') }}</h5>
                    <hr/>
                </div>
                <div class="col-md-8 settings-contents">
                    <table class="settings-table">
                        <tr>
                            <th>
                                {{ __('pages.settings.environment') }}:
                            </th>
                            <td>
                                <span class="text-capitalize">{{ config('app.env') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.phpversion') }}:
                            </th>
                            <td>
                                {{ phpversion() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.info') }}:
                            </th>
                            <td>
                                <a href="{{ route('settings.server.phpinfo') }}" target="_blank">{{ __('pages.settings.phpinfo') }}<i class="bi-box-arrow-up-right ms-2"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.timezone') }}:
                            </th>
                            <td>
                                {{ config('app.timezone') . ' - ' . now() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.git_status') }}:
                            </th>
                            <td>
                                {!! $git_text !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.debugging') }}:
                            </th>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="debuggingOptionSwitch"{{ config('app.debug') ? ' checked':'' }}>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.build') }}:
                            </th>
                            <td>
                                {{ config('app.build') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('pages.settings.release') }}:
                            </th>
                            <td>
                                {{ config('app.release') }}
                            </td>
                        </tr>
                    </table>
                    <div class="btn-row">
                        <a href="{{ route('settings.server.clearcache') }}" class="btn btn-outline-primary">{{ __('pages.settings.cache_clear') }}</a>
                        <a href="{{ route('telescope') }}" class="btn btn-outline-primary">{{ __('pages.settings.telescope') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="section-title">{{ __('Serwer poczty wychodzącej (SMTP)') }}</h5>
                    <hr/>
                </div>
                <div class="col-md-8 settings-contents">
                    <div class="row">
                        {{ $form->render() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


@endsection
@section('page-scripts')

@endsection
