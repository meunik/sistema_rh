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
        <div class="white-box p-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md col-form-label text-md-right">Nome Completo</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md col-form-label text-md-right">Endereço de E-mail</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md col-form-label text-md-right">Senha</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md col-form-label text-md-right">Confirmação da Senha</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar
                        </button>
                    </div>
                </div>
                <div class="form-group row mt-3 mb-0">
                    <div class="col-md-6">
                        <p>Voltar para <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Login</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br><br><br>
</section>
@endsection