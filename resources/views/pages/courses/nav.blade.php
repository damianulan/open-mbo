<div class="container-fluid">
    <div class="page-menu">
        <ul class="nav nav-pills-horizontal">
            <li class="nav-item">
                <a class="nav-link{{ request()->routeIs('courses.index.*') ? ' active':'' }}" href="{{ route('courses.index', 'tile') }}">
                    <i class="bi-mortarboard-fill"></i>
                    Wszystkie kursy
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi-vector-pen"></i>
                    Moje kursy
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi-person-fill-add"></i>
                    Zapisy na szkolenia
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi-calendar2-range-fill"></i>
                    Terminarz
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi-person-workspace"></i>
                    Prowadzący
                </a>
            </li>

            <li class="nav-item ms-auto">
                <a class="nav-link" href="{{ route('courses.create') }}">
                    <i class="bi-plus-lg"></i>
                    Utwórz
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi-list-nested"></i>
                    Kategorie
                </a>
            </li>
        </ul>
    </div>
</div>
