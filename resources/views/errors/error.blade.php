@extends('errors.master', [
    'pagetitle' => "$errorCode ".__('pages.errors.'.$errorCode.'.title')
])
@php
    // TODO - include error reporting to the database
@endphp
@section('content')
<div class="d-flex justify-center error-page container">
    <div class="text-center leading-error m-auto">
            <div class="error-icon"><i class="{{ $icon }}"></i></div>
            <div class="error-code">{{ $errorCode }}</div>
                <p class="error-title">
                    {{ __('pages.errors.'.$errorCode.'.title') }}
                </p>
                @if(isset($message) && !empty($message) && config('app.debug'))
                    <p class="error-paragraph">
                        {!! $message !!}
                    </p>
                @else
                    <p class="error-paragraph">
                        {{ __('pages.errors.'.$errorCode.'.paragraph') }}
                    </p>
                @endif

                @if($errorCode !== '503')
                    <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('buttons.redirect_back') }}</a>
                @else
                    <a href="{{ url('/') }}" class="btn btn-primary">{{ __('buttons.redirect_login') }}</a>
                @endif
          </div>
  </div>
@endsection
