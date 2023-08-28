@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')

<div class="container-fluid">
    @include('pages.campaigns.nav')

    <div class="row">
        <div class="col-md-4 card-col">
            @include('components.campaign-card')
        </div>
        <div class="col-md-4 card-col">
            <div class="card card-url inactive campaign-card" data-url="">
                <div class="card-body">
                    <div class="card-top">
                        <div class="card-title" data-bs-toggle="tooltip" data-bs-title="Kampania xxx">
                            Kampania xxx
                        </div>
                        <div class="action-btns">
                            <a href="#">
                                <i class="bi-people-fill"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-text">
                        Przykładowy opis kamapii
                    </div>
                    <div class="row details">
                        <div class="col-md-6">
                            <div class="element" data-bs-toggle="tooltip" data-bs-title="Kategoria">
                                <i class="bi bi-list-nested me-2 text-secondary"></i>
                                <span class="element-title">
                                    Kategoria ??
                                </span>
                            </div>
                            <div class="element" data-bs-toggle="tooltip" data-bs-title="">
                                <i class="bi bi-calendar-x me-2"></i>
                                <span class="element-title">
                                    Dostępność
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="element" data-bs-toggle="tooltip" data-bs-title="">
                                <i class="bi bi-person-fill me-2"></i>
                                <span class="element-title">
                                    Damian Ułan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection
