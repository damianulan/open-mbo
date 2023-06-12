@php
    $progress = 20;
@endphp
<div class="card course-card" data-url="{{ route('courses.show', 3) }}">
    <div class="course-img" style="background-image: url('{{ asset('themes/light/images/courses/course5.jpg') }}');"></div>
    <div class="card-body">
        <div class="card-title" title="{{ lorem_title() }}">
            {{ lorem_title() }}
        </div>
        <div class="card-text">
            {{ lorem() }}
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