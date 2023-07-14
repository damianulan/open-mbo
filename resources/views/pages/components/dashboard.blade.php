<div class="row course-cards">
    <h4 class="dashboard-widget-title">Moje kursy</h4>
    @if(!empty($courses))
        @foreach($courses as $course)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-3">
                {{ $course->renderCard() }}
            </div>
        @endforeach
    @endif
</div>
<div class="row pt-5">
    <div class="col-md-8">
        <div class="row path-cards">
            <h4 class="dashboard-widget-title">Moje ścieżki</h4>
            <!--<div class="col-md-3">
            </div> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <h4 class="dashboard-widget-title">Moje zadania</h4>
            <div class="col-md-12">

            </div>
        </div>
    </div>
</div>
