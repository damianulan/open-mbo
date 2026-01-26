@extends('layouts.portal.master')
@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-serif">{{ __('globals.hello') }}, {{ auth()->user()->firstname }}</h2>
        </div>
    </div>
</div>

<div class="row">
    @if(auth()->user()->campaigns_ongoing->count())
        <div class="col-lg-8">
            <div class="content-card content-card-sm">
                <div class="content-card-top">
                    <div class="content-card-header">
                        <i class="bi-bullseye me-2"></i>
                        <div>{{ __('pages.home.my_campaigns') }}</div>
                    </div>
                    <div class="content-card-icons ms-auto">
                        <i class="minimize"></i>
                    </div>
                </div>
                <div class="content-card-body">
                    <x-my-campaigns-summary />
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-4 col-sm-12">
        <div class="content-card content-card-sm">
            <div class="content-card-top">
                <div class="content-card-header">
                    <i class="bi-clipboard-check-fill me-2"></i>
                    <div>{{ __('pages.home.my_objectives') }}</div>
                </div>
                <div class="content-card-icons ms-auto">
                    <i class="minimize"></i>
                </div>
            </div>
            <div class="content-card-body">
                <x-objectives-list :model="$user" :user="$user" />
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
@endpush
