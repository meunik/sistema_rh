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
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>

                        <div class="col-md">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enviar link de redefinição de senha') }}
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
    </div>
    <br><br><br>
</section>
@endsection