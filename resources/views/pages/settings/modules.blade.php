@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
@include('pages.settings.nav')

<div class="container settings">
    <div class="section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h5 class="section-title">{{ __('pages.settings.modules') }}</h5>
                <hr/>
            </div>
        </div>
        <div class="row">
            @foreach($modules as $name => $properties)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-6 pt-3">
                <div class="card module-card{{ $properties->active ? ' active':'' }}" data-uuid="{{ $properties->id }}">
                    <div class="module-icon">
                        <i class="{{ $properties->icon }}"></i>
                    </div>
                    <div class="module-title">
                        {{ $properties->title() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('page-scripts')

@endsection