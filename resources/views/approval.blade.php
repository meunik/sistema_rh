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
                <div class="form-group">
                    <b class="text-danger">Aguardando Aprovação</b>
                    <a href="{{ route('logout') }}" class="text-primary float-right m-l-5"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><b>{{ __('Logout') }}</b></a>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md">
                        <p>
                            Sua conta está aguardando aprovação do adminstrador.
                            <br />
                            Por favor, volte mais tarde.
                        </p>
                    </div>
                </div>
                {{-- <div class="form-group row mt-3 mb-0">
                    <div class="col-md-6">
                        <p>Voltar para <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Login</b></a></p>
                    </div>
                </div> --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
</section>
@endsection
