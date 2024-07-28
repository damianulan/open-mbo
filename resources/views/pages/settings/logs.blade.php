@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-container row">
                {{ $table->columnSelector() }}
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>


@endsection
@section('page-scripts')
{{ $dataTable->scripts() }}
@endsection
