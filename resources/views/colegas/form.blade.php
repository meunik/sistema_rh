@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12 m-t-10">
                <form method="POST" action="{{ route('colegas') }}">
                    @csrf
                    <h2 class="font-bold text-center"><i class="fa-fw icon-user-follow"></i> Cadastro de Colegas</h2>
                        <input type="hidden" id="id" name="id" value="{{$colega ? $colega->id : ''}}">
                        <div class="col-xs-12 form-dialises-border m-t-40-sm">
                            <div class="row btn-xs-r text-right">
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label txt-label-form text-right">Nome:</label>
                                        <div class="col-sm-6">
                                            <input id="nome" type="text" class="form-control" name="nome" style="max-width: 500px;" value="{{$colega ? $colega->nome : old('nome')}}" required autocomplete="nome" autofocus>
                                            @error('nome')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="hospitais_id" class="col-sm-3 control-label txt-label-form txt-label-form">Hospital:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="hospitais_id" style="max-width: 500px;" required>
                                                <option value="" selected disabled>Selecione</option>
                                                @foreach ($hospitais as $hospital)
                                                    <option value="{{$hospital->id}}"
                                                        {{$colega ?
                                                            $colega->hospitais_id == $hospital->id ?
                                                            "selected"
                                                            : ""
                                                            : ""}}>
                                                        {{$hospital->nome}} - {{$hospital->local}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="data_de_nascimento" class="col-sm-3 control-label txt-label-form text-right">Data de Nascimento:</label>
                                        <div class="col-sm-6">
                                            <input id="data_de_nascimento" type="date" class="form-control" name="data_de_nascimento" style="max-width: 190px;" value="{{$colega ? $colega->data_de_nascimento : old('data_de_nascimento')}}"  autocomplete="data_de_nascimento" autofocus>
                                            @error('data_de_nascimento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="chapa" class="col-sm-3 control-label txt-label-form text-right">Chapa:</label>
                                        <div class="col-sm-6">
                                            <input id="chapa" type="text" class="form-control" name="chapa" style="max-width: 190px;" value="{{$colega ? $colega->chapa : old('chapa')}}"  autocomplete="chapa" autofocus>
                                            @error('chapa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="centro_de_custo" class="col-sm-3 control-label txt-label-form text-right">Centro de Custo:</label>
                                        <div class="col-sm-6">
                                            <input id="centro_de_custo" type="text" class="form-control" name="centro_de_custo" style="max-width: 400px;" value="{{$colega ? $colega->centro_de_custo : old('centro_de_custo')}}"  autocomplete="centro_de_custo" autofocus>
                                            @error('centro_de_custo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="funcao" class="col-sm-3 control-label txt-label-form text-right">Função:</label>
                                        <div class="col-sm-6">
                                            <input id="funcao" type="text" class="form-control" name="funcao" style="max-width: 500px;" value="{{$colega ? $colega->funcao : old('funcao')}}"  autocomplete="funcao" autofocus>
                                            @error('funcao')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="secao" class="col-sm-3 control-label txt-label-form text-right">Seção:</label>
                                        <div class="col-sm-6">
                                            <input id="secao" type="text" class="form-control" name="secao" style="max-width: 500px;" value="{{$colega ? $colega->secao : old('secao')}}"  autocomplete="secao" autofocus>
                                            @error('secao')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="admissao" class="col-sm-3 control-label txt-label-form text-right">Data de Admissão:</label>
                                        <div class="col-sm-6">
                                            <input id="admissao" type="date" class="form-control" name="admissao" style="max-width: 190px;" value="{{$colega ? $colega->admissao : old('admissao')}}"  autocomplete="admissao" autofocus>
                                            @error('admissao')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="codigo_horario" class="col-sm-3 control-label txt-label-form text-right">Cd. Horário:</label>
                                        <div class="col-sm-6">
                                            <input id="codigo_horario" type="text" class="form-control" name="codigo_horario" style="max-width: 190px;" value="{{$colega ? $colega->codigo_horario : old('codigo_horario')}}"  autocomplete="codigo_horario" autofocus>
                                            @error('codigo_horario')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="horario" class="col-sm-3 control-label txt-label-form text-right">Horário:</label>
                                        <div class="col-sm-6">
                                            <input id="horario" type="text" class="form-control" name="horario" style="max-width: 500px;" value="{{$colega ? $colega->horario : old('horario')}}"  autocomplete="horario" autofocus>
                                            @error('horario')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="jornada" class="col-sm-3 control-label txt-label-form text-right">Jornada:</label>
                                        <div class="col-sm-6">
                                            <input id="jornada" type="number" class="form-control" name="jornada" style="max-width: 500px;" value="{{$colega ? $colega->jornada : old('jornada')}}"  autocomplete="jornada" autofocus>
                                            @error('jornada')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0 m-b-10">
                                    <div class="form-group">
                                        <label for="telefone" class="col-sm-3 control-label txt-label-form text-right">Telefone:</label>
                                        <div class="col-sm-6">
                                            <input id="telefone" type="text" class="form-control" name="telefone" style="max-width: 250px;" value="{{$colega ? $colega->telefone : old('telefone')}}"  autocomplete="telefone" autofocus>
                                            @error('telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button class="col-md-offset-9 col-md-3 btn btn-primary" type="submit">
                                    {{$colega ? "Salvar" : "Cadastrar"}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 table-responsive">
                <table id="colegas" class="table table-bordered table-condensed">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">Nome</th>
                            <th class="text-center">Hospital</th>
                            <th class="text-center">Data de Admissão</th>
                            <th class="text-center">Função</th>
                            <th class="text-center">Seção</th>
                            <th class="text-center">Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colegas as $colega)
                        <tr class="text-center text-nowrap">
                            <td>{{$colega->nome}}</td>
                            <td>@isset($colega->hospital) {{$colega->hospital->nome}} @endisset</td>
                            <td>{{$colega->admissao}}</td>
                            <td>{{$colega->funcao}}</td>
                            <td>{{$colega->secao}}</td>
                            <td>{{$colega->telefone}}</td>
                            <td>
                                <a class="btn btn-primary waves-effect waves-light m-t-10" href="\colegas?id={{$colega->id}}"><i class="icon-pencil"></i> Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    <tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>

function editarColega(id) {
    var params = {
            'id': id,
    };
    var url = '/colegas?' + jQuery.param(params);
    window.location.href = url;
}

</script>

<script>
    $(document).ready( function () {
        $('#colegas').DataTable({
            "language": {
                "url": "/Portuguese-Brasil.json"
            }
        });
    });
</script>

@endsection
