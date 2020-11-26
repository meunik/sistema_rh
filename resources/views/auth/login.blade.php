@extends('layouts.app')
@section('content')
<section id="wrapper" class="login-register">
    <div class="form-group text-center">
        <div class="col-xs-12">
            <img src="plugins/images/unnamed.png" class="" alt="">
        </div>
    </div>
    <br>
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                @csrf
                {{-- <h3 class="box-title m-b-20">Login</h3> --}}
                <div class="col-xs-12 m-t-20 form-group input-group">
                    <div class="form-control-feedback"><i class="ti-user"></i></div>
                    <div class="col-xs m-l-15">
                        <input id="email" type="email" placeholder="E-mail" class="form-control p-l-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 form-group input-group">
                    <div class="form-control-feedback"><i class="ti-lock"></i></div>
                    <div class="col-xs m-l-15">
                        <input id="password" type="password" maxlength="16" placeholder="Senha" class="form-control p-l-5 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="pull-left p-t-0 p-b-10">
                            <div class="">
                                <div class="form-check checkbox checkbox-primary">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label p-l-10" for="remember">
                                        {{ __('Lembre de mim') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link text-dark pull-right" href="{{ route('password.request') }}">
                                <i class="fa fa-lock m-r-5"></i>
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif --}}
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
                {{-- <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>Ainda nè´™o possui uma conta? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>{{ __('Registre-se') }}</b></a></p>
                    </div>
                </div> --}}
            </form>
        </div>
    </div>
    <br><br><br>
</section>
@endsection