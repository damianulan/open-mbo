<div class="course-details">
    <div class="d-flex">
        <a class="me-3" href="#"><i class="bi-2 bi-gear"></i></a>
        <a class="me-3" href="{{ route('courses.edit', $course->id) }}"><i class="bi-2 bi-pencil"></i></a>
    </div>
    <div class="course-img" style="background-image: url('{{ $course->loadPicture() }}');"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="summary">
                <p>
                   {!! $course->description->get() !!}
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="h-100">
            </div>
        </div>
    </div>
</div>
