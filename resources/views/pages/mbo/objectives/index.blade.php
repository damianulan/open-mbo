@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}
<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn add-objective" href="javascript:void(0);" data-tippy-content="{{ __('buttons.add_objective') }}">
            <i class="bi-plus-circle-fill"></i>
        </a>
    </div>
</div>
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
<script type="text/javascript">
    function add_users(objective_id) {
        $.getModal('objectives.add_users', {id: objective_id});
    }

    function edit_objective(objective_id) {
        $.getModal('objectives.add_objectives', {id: objective_id});
    }

    $('.add-objective').on('click', function() {
        $.getModal('objectives.add_objectives');
    });
</script>
@endpush
