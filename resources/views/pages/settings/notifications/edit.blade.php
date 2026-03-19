@extends('layouts.portal.master')
@section('content')

<div class="content-card">
    <div class="container">
        {{ $form->render() }}
    </div>
</div>

@endsection
@push('scripts')
    {{ $form->scripts() }}
@endpush
