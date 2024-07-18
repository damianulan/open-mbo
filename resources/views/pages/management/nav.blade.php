<div class="page-menu">
    <ul class="nav nav-pills-horizontal">
        <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('management.objectives.index') ? ' active':'' }}" href="{{ route('management.objectives.index') }}">
                {{ __('menus.management.objectives.index') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.management.categories') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.management.questionnaire') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.management.users') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('management.organization.index') ? ' active':'' }}" href="{{ route('management.organization.index') }}">
                {{ __('menus.management.organization.index') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.notifications') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.reports.index') }}
            </a>
        </li>
    </ul>
</div>
