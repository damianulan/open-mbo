@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="content-card">
    <div class="container">
        {{ $form->render() }}
    </div>
</div>
@endsection
@section('page-scripts')

@endsection
