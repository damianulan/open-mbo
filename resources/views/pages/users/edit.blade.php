@extends('layouts.portal.master')
@section('content')
@php
    if(isset($user) && $user->hasRole('root')){
        session()->now('warning', __('alerts.users.warning.user_is_root'));
    }
@endphp
@include('layouts.components.alerts')

<div class="content-card">
    <div class="container">
        {{ $form->render() }}
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
