@extends('layouts.app')
@section('content')
<section id="wrapper" class="login-register">
    <div class="form-group text-center">
        <div class="col-xs-12">
            <img src="{{URL::asset('plugins/images/unnamed.png')}}" class="" alt="">
        </div>
    </div>
    <br>
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-form-label text-md-right">{{ __('Senha') }}</label>

                    <div class="col-md">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirme sua Senha') }}</label>

                    <div class="col-md">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Redefinir senha') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row mt-2 mb-0">
                    <div class="col-md-6 offset-md-4">
                        <p>Voltar para <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Login</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
</section>
@endsection