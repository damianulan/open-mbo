@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('settings.organization.company.create') }}" data-tippy-content="{{ __('buttons.add') }}">
            <i class="bi-plus-circle-fill"></i>
        </a>
    </div>
</div>
<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            <div class="table-container row">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
