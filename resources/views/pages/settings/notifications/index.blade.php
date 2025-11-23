@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-container row">
                {{ $table->actions() }}
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
