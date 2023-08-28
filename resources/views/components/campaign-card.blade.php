@php
    $progress=30;
@endphp
<div class="card card-url campaign-card" data-url="">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-bs-toggle="tooltip" data-bs-title="Kampania xxx">
                {{ lorem_title() }}
            </div>
            <div class="campaign-badges">
                <div></div>
                <div data-bs-toggle="tooltip" data-bs-title="Kopia robocza">
                    <span class="badge bg-secondary">Draft</span>
                </div>
                <div data-bs-toggle="tooltip" data-bs-title="Kampania w toku">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div data-bs-toggle="tooltip" data-bs-title="Tryb ręczny">
                    <i class="bi bi-hand-index-thumb-fill"></i>
                </div>
                <div data-bs-toggle="tooltip" data-bs-title="Okres pomiaru">
                    <span class="badge bg-secondary">2023 Q3</span>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ lorem_paragraph() }}
        </div>
        <div class="row details">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Data startu pomiaru">
                        <i class="bi bi bi-calendar-check me-2"></i>
                        <span>23.09.2023</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Data końca pomiaru">
                        <i class="bi bi-calendar-x me-2"></i>
                        <span>20.12.2023</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Ilość uczestników">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>24</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Cele podstawowe">
                        <i class="bi bi-bullseye me-2"></i>
                        <span>8</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Autor kampanii">
                        <i class="bi bi-person-fill me-2"></i>
                        <span>Damian Ułan</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-card-progressbar :progress="$progress"/>
</div>
