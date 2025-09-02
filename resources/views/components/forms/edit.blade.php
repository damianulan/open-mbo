@extends('layouts.portal.master')
@section('content')

<div class="content-card">
    <div class=" content-card-body container">
        {{ $form->render() }}
    </div>
</div>
@endsection
@push('scripts')

@endpush
