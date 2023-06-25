@props(['id', 'title', 'descr', 'picture', 'category', 'available_from' => '', 'progress' => 0])

<div class="card course-card" data-url="{{ route('courses.show', $id) }}">
    <div class="course-img" style="background-image: url('{{ $picture }}');"></div>
    <div class="card-body">
        <div class="card-title" data-bs-toggle="tooltip" data-bs-title="{{ $title }}">
            {{ $title }}
        </div>
        <div class="card-text">
            {{  $descr  }}
        </div>
        <div class="row details">
            <div class="col-md-6 col-sm-12">
                <div class="element" data-bs-toggle="tooltip" data-bs-title="{{ __('pages.courses.category') }}">
                    <i class="bi bi-list-nested me-2 text-secondary"></i>
                    {{ $category }}
                </div>
                <div class="element">
                    <i class="bi bi-calendar-x me-2"></i>
                    {{ date('d.m.Y', strtotime($available_from)) }}
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
    @if($progress > 0)
    <x-course-progressbar :progress="$progress"/>
    @endif
    <!--
    <div class="action-panel">
        <div class="action-btns">
            <a href="#"><i class="bi-person-fill-up"></i></a>
            <a href="#"><i class="bi-gear-fill"></i></a>
        </div>
    </div>-->
</div>
