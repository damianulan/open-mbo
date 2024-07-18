@extends('layouts.portal.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="text-serif">{{ __('vocabulary.hello') }}, {{ auth()->user()->firstname() }}</h2>
    </div>
</div>
<x-nocontent-page/>

@endsection
@section('page-scripts')
@endsection
