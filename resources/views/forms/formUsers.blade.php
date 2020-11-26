@extends('layout')

@section('head')
<!-- ===== Plugin CSS ===== -->
<link href="{{URL::asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('plugins/components/custom-select/custom-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('plugins/components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('plugins/components/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<link href="{{URL::asset('plugins/components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<style>    
    .select2-container-multi .select2-choices {
        min-height: 26px;
        border-radius: 1px!important;
        border: 1px solid #e5ebec;
    }
    .select2-container-multi.select2-container-active .select2-choices {
        min-height: 26px;
        border-radius: 1px!important;
        border: 1px solid #000000;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">
        @if(Auth::user()->is_admin == 'AD')
        <div class="row">
            <div class="col-md-12 m-t-10">
                <form method="POST" id="criarClinica" @if(isset($user->id)) action="/users" @else action="{{ route('register') }}" @endif>
                @if(isset($user->id))
                    <input type="hidden" name="_method" value="put" />
                @endif
                @csrf
                    <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : '' }}" />
                    <h2 class="font-bold text-center"><i class="fa-fw icon-user-follow"></i> Cadastro de Usuarios</h2>
                    <div class="col-xs-12 p-0">
                        <div class="col-xs-12 form-dialises-border m-t-40-sm">
                            <div class="row btn-xs-r text-right">
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label txt-label-form text-right">Nome:</label>
                                        <div class="col-sm-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user->name) ? $user->name :old('name') }}" required autocomplete="name" autofocus>
                
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label txt-label-form text-right">Endereço de E-mail:</label>
                                        <div class="col-sm-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user->email) ? $user->email :old('email') }}" required autocomplete="email">
                
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label txt-label-form text-right">Senha:</label>
                                        <div class="col-sm-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" @if(isset($user->id)) @else required @endif autocomplete="new-password">
                
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-sm-3 control-label txt-label-form text-right">Confirmação da Senha:</label>
                                        <div class="col-sm-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(isset($user->id)) @else required @endif autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="hospitais_id" class="col-sm-3 control-label txt-label-form txt-label-form">Hospital:</label>
                                        <div class="col-sm-4">
                                            <select class="select2 select2-multiple" name="hospitais_id[]" multiple="multiple" multiple>
                                                <option selected disabled>Selecione</option>
                                                @foreach ($hospitais as $hospital)
                                                    <option value="{{$hospital->id}}" @if(isset($user)) @foreach($user->hospitais as $selected) @if($selected->hospitais_id == $hospital->id) selected="selected" @endif @endforeach @endif>{{$hospital->nome}} - {{$hospital->local}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="is_admin" class="col-sm-3 control-label txt-label-form txt-label-form">Permissão:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="is_admin">
                                                <option value="NULL">Usuário</option>
                                                <option value="AD" @if(isset($user)) @if($user->is_admin == 'AD') selected="selected" @endif @endif>Administrador Geral</option>
                                                <option value="CL" @if(isset($user)) @if($user->is_admin == 'CL') selected="selected" @endif @endif>Administrador de Hospitais</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="col-md-offset-9 col-md-3 btn btn-primary" type="submit">@if(isset($user->id)) Salvar @else Cadastrar @endif</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            
            <div class="col-md-12 table-responsive">
                <table id="resultadoUsers" class="table table-bordered table-condensed">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">Nome</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Registrado em</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="text-center text-nowrap">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a class="btn btn-primary waves-effect waves-light m-t-10" href="\users?id={{$user->id}}"><i class="icon-pencil"></i> Editar</a>
                                <form method="POST" action="/users">
                                    <input type="hidden" name="_method" value="delete" />
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}" />
                                    <button type="submit" class="btn btn-danger waves-effect waves-light m-t-10" href="/form"><i class="icon-trash"></i> Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row">
            <h2 class="font-semibold text-center"><i class="fa fa-ban"></i> No momento você não tem permissão para acessar esta página</h2>
        </div>
        @endif
    </div>
</div>
@endsection

@section('script')

<script src="{{URL::asset('plugins/components/switchery/dist/switchery.min.js')}}"></script>
<script src="{{URL::asset('plugins/components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('plugins/components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('plugins/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{URL::asset('plugins/components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
<script>
    $(".select2").select2();
</script>
<!-- jQuery -->  
<script src="{{URL::asset('plugins/components/jquery/dist/jquery.min.js')}}"></script>
<!-- DataTables -->
<script type="text/javascript" src="{{URL::asset('https://cdn.datatables.net/v/bs/dt-1.10.20/datatables.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $('#resultadoUsers').DataTable({
            "language": {
                "url": "/Portuguese-Brasil.json"
            }
        });
    });
</script>
        
<!--Style Switcher -->
<script src="{{URL::asset('plugins/components/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endsection
