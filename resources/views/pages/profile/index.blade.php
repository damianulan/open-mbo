@extends('layouts.portal.master')
@section('content')

@include('pages.profile.nav')

<div class="content-card">
    <div class="content-card-top">
        <div class="content-card-header">
            <div class="content-card-title">{{ __('menus.profile.edit') }}</div>
        </div>
    </div>
    <div class="content-card-body container">
        {{ $form->render() }}
    </div>
</div>

@endsection
@push('scripts')
    {{ $form->scripts() }}
@endpush
