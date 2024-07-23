@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('campaigns.edit', $campaign->id) }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-objective" data-tippy-content="{{ __('Dodaj cele') }}"><i class="bi-heart-arrow"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-users" data-tippy-content="{{ __('Zapisz użytkowników') }}"><i class="bi-person-fill-up"></i></a>
    </div>
</div>
<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            {!! $campaign->description->get() !!}
        </div>
    </div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 pt-3">
                <h4>Cele</h4>
                <ul class="ombo-list">
                    @if(count($campaign->objectives))
                        @foreach ($campaign->objectives as $objective)
                        <li>
                            <div class="list-grid">
                                <div class="list-content">
                                    <i class="bi text-primary bi-bullseye me-1"></i>
                                    <span>{{ $objective->name }}</span>
                                </div>
                                <div class="list-actions">
                                    <div class="list-action me-3" data-tippy-content="Waga celu">
                                        <i class="bi-minecart-loaded"></i>
                                        <span>{{ $objective->weight }}</span>
                                    </div>
                                    <div class="list-action me-3" data-tippy-content="{{ __('forms.objectives.expected') }}">
                                        <i class="bi-heart-arrow"></i>
                                        <span>{{ $objective->expected }}</span>
                                    </div>
                                    <a href="javascript:void(0);" class="list-action edit-objective" data-modelid="{{ $objective->id }}" data-tippy-content="Edytuj">
                                        <i class="bi-pencil-fill"></i>
                                    </a>
                                    <a href="#" class="list-action" data-tippy-content="Usuń">
                                        <i class="bi-x-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @endif

                </ul>
            </div>
            <div class="col-md-5 offset-md-2 pt-3">
                <h4>Zapisani użytkownicy</h4>
                <ul class="ombo-list">
                    <li>
                        <div class="list-grid">
                            <div class="list-content">
                                <i class="bi text-primary bi-person me-1"></i>
                                <span>Damian Ułan</span>
                            </div>
                            <div class="list-actions">
                                <a href="#" class="list-action">
                                    <i class="bi-x-lg"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
@section('page-scripts')
<script type="text/javascript">
    var campaign_id = '{{ $campaign->id }}';
    $('.add-objective').on('click', function() {
        $.getModal('campaigns.add_objectives', {campaign_id: campaign_id});
    });
    $('.edit-objective').on('click', function() {
        var model_id = $(this).attr('data-modelid');

        $.getModal('campaigns.add_objectives', {id: model_id});
    });
</script>
@endsection
