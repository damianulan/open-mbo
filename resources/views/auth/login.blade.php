@extends('auth.master')

@section('content')
<div class="container pt-5 auth">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-5">
            <div class="card logincard">
                <div class="d-flex">
                    <div class="card-header mx-auto">
                        @branding
                    </div>
                </div>

                <div class="card-body pt-0">
                    @if(config('app.env') !== 'production' && config('app.maintenance') === false)
                        <div class="alert alert-primary mx-5 px-5 mb-4">
                            <div class="text-center">{!! __('auth.login_info') !!}</div>
                            <div class="text-center pt-3">
                                <div><strong>{{ __('fields.login') }}:</strong> admin@damianulan.me</div>
                                <div><strong>{{ __('fields.password') }}:</strong> 123456</div>
                            </div>
                        </div>
                    @elseif(config('app.maintenance') === true)
                        <div class="alert alert-danger mx-5 px-5 mb-4">
                            <div class="text-center">{!! __('auth.maintenance_info') !!}</div>
                        </div>

                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('fields.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('fields.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('menus.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('menus.login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('menus.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    @if(config('app.env') !== 'production')
                    <div class="mx-5 mt-3">
                        <div class="row">
                            <div class="col-md-12 text-muted d-flex">
                                <div class="login-version">
                                    Release: {{ config('app.release') }}
                                </div>
                                <div class="login-build ms-auto">
                                    Build: {{ config('app.build') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
