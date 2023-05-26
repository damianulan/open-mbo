@php
    $progress = 20;
@endphp
<div class="card course-card">
    <div class="course-img" style="background-image: url('{{ asset('themes/light/images/courses/course5.jpg') }}');"></div>
    <div class="card-body">
        <div class="card-title" title="Kurs zamartwiania się bardzo mocno mam dość">
            Kurs przykładowy frontend
        </div>
        <div class="card-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="row details">
            <div class="col-md-6 col-sm-12">
                <div class="element">
                    <i class="bi bi-tag-fill me-2 text-secondary"></i>
                    Głupie kategorie
                </div>
                <div class="element">
                    <i class="bi bi-calendar-x me-2"></i>
                    10.12.2023
                </div>
            </div>
            <div class="col-md-6">
                <div class="element">
                    <i class="bi bi-person-fill me-2"></i>
                    Damian Ułan 
                </div>
            </div>
        </div>
    </div>
    <x-course-progressbar :progress="$progress"/>
</div>