@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">
    <div class="container pt-4">
        {{ $form->render() }}
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
