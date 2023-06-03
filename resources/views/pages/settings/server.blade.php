@extends('layouts.portal.master')
@section('content')

@include('pages.settings.nav')
@include('layouts.components.alerts')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h5>{{ __('pages.settings.server_info') }}</h5>
            <hr/>
        </div>
        <div class="col-md-8">
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
                        {!! $debugging_text !!}
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
            <div class="d-flex">
                <a href="{{ route('settings.clearcache') }}" class="btn btn-primary">{{ __('pages.settings.cache_clear') }}</a>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-8">
            <h5>{{ __('Serwer pocztowy') }}</h5>
            <hr/>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control datetimepicker">
            <select class="form-control">
                <option>aaaa</option>
                <option>bbbb</option>
            </select>
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection