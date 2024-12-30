<nav class="icon-btn-nav">
    <div class="panel-left">
        @can('mbo-campaign-create')
            <a class="icon-btn" href="{{ route('campaigns.create') }}" data-tippy-content="{{ __('buttons.add') }}"><i class="bi-plus-circle-fill"></i></a>
        @endcan
    </div>
</nav>
