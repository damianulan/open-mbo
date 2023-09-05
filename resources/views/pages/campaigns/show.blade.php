@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('campaigns.edit', $campaign->id) }}" data-bs-toggle="tooltip" data-bs-title="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        <a class="icon-btn" href="" data-bs-toggle="tooltip" data-bs-title="{{ __('Dodaj cele') }}"><i class="bi-heart-arrow"></i></a>
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
                    <li>
                        <div class="list-grid">
                            <div class="list-content">
                                <i class="bi text-primary bi-bullseye me-1"></i>
                                Cel 1
                            </div>
                            <div class="list-actions">
                                <div class="list-action me-3" data-bs-toggle="tooltip" data-bs-title="Waga celu">
                                    <i class="bi-minecart-loaded"></i>
                                    <span>0.8</span>
                                </div>
                                <div class="list-action me-3" data-bs-toggle="tooltip" data-bs-title="Oczekiwany poziom realizacji">
                                    <i class="bi-heart-arrow"></i>
                                    <span>3600</span>
                                </div>
                                <a href="#" class="list-action" data-bs-toggle="tooltip" data-bs-title="Usuń">
                                    <i class="bi-x-lg"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-5 offset-md-2 pt-3">
                <h4>Zapisani użytkownicy</h4>
                <ul class="ombo-list">
                    <li>
                        <div class="list-grid">
                            <div class="list-content">
                                <i class="bi text-primary bi-person me-1"></i>
                                Damian Ułan
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

@endsection
