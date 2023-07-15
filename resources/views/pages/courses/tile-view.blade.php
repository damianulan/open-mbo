<div class="row course-card">
    @foreach($courses as $course)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-4">
        {{ $course->renderCard() }}
    </div>
    @endforeach
</div>
