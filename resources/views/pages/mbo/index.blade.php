@extends('layouts.portal.master')
@section('content')

    {!! $nav->render() !!}

    <nav class="icon-btn-nav">
        <div class="panel-left">
            <a class="icon-btn" href="{{ route('templates.create') }}" data-tippy-content="{{ __('buttons.create_template') }}">
                <i class="bi-plus-circle-fill"></i>
            </a>
        </div>
    </nav>
    @if (count($objectives))
        <div class="content-card">
            <div class="content-card-body">
                <div class="row pagination-row">
                    <div class="col-md-12">
                        {{ $objectives->links() }}
                    </div>
                </div>
                <div class="row">
                    @foreach($objectives as $objective)
                        <div class="col-md-4 pb-3">
                            @include('components.mbo.objective-card')
                        </div>
                    @endforeach
                </div>
                <div class="row pagination-row">
                    <div class="col-md-12">
                        {{ $objectives->links() }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <x-nocontent-page/>
    @endif


@endsection
@push('scripts')

@endpush
