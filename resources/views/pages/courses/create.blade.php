@extends('layouts.portal.master')
@section('content')

<div class="container-fluid">
    @include('layouts.components.alerts')

    <div class="row pt-5">
        <div class="col-md-8 offset-md-1">
            {{ $form->render() }}
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection