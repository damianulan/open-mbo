@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
@include('pages.management.nav')

<div class="container-fluid">
    <div class="icon-btn-nav">
        <div class="panel-left">
            <a class="icon-btn" href="{{ route('management.objectives.create') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.create_template') }}">
                <i class="bi-plus-circle-fill"></i>
            </a>
            {{-- <a class="icon-btn" href="#" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.create_template') }}">
                <i class="bi-person-fill-up"></i>
            </a> --}}
        </div>
    </div>
</div>

@endsection
@section('page-scripts')
<script>
document.onkeypress = function(myEvent) { // doesn't have to be "e"
    console.log(myEvent.which);
};
</script>

@endsection
