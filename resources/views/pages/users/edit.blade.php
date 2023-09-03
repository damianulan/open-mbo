@extends('layouts.portal.master')
@section('content')
@php
    if($user->hasRole('root')){
        session()->now('warning', __('alerts.users.warning.user_is_root'));
    }
@endphp
@include('layouts.components.alerts')

<div class="container-fluid">
    <div class="container pt-4">
        {{ $form->render() }}
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
