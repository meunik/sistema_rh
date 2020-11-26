@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="form-group">
            <h3 class="text-center"><i class="fa fa-user"></i></h3>
            <label for="nome" class="col-sm-2 control-label">Filial:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" autocomplete="off" name="nome" id="nome" value="{{$hospital ? $hospital->nome : ''}}" placeholder="Filial" onKeyup="getHospital(this.value)">
                <div id="listaNome"></div>
            </div>
        </div>
        @if($resultados->count() > 0)
            <div id="formDiv" class="col-sm-12 row p-0 hidden">
                <div class="table-responsive">
                    <table id="resultado" class="table table-bordered table-condensed">
                        <thead>
                            <tr class="active text-center text-nowrap">
                                <th>
                                    ACOMPANHAMENTO DIÁRIO
                                </th>
                                <th class="text-left" class="w-200">
                                    <label for="data" class="control-label p-0">Data:</label>
                                    <div class="">
                                        <input type="date" class="form-control" class="w-200" autocomplete="off" id="data" name="data" onchange="dataInput(this.value)">
                                    </div>
                                </th>
                                <th></th>
                                <th>
                                    <label for="data" class="control-label p-0">Pesquisar Nome:</label>
                                    <div class="">
                                        <input id="searchName" class="form-control w-200" onkeyup="searchName(this.value)" type="text" placeholder="Pesquisar Nome" />
                                    </div>
                                </th>
                                <th colspan="9"></th>
                                <th></th>
                            </tr>
                            <tr class="success">
                                <th class="text-center w-300">Nome</th>
                                <th class="w-200"></th>
                                <th class="w-200"></th>
                                <th class="w-200">Cod</th>
                                <th colspan="9"></th>
                                <th class="w-100"></th>
                            </tr>
                            {{-- <tr class="success">
                                <th class="text-center w-300">
                                    <input id="searchName" onkeyup="searchName(this.value)" type="text" placeholder="Pesquisar Nome" />
                                </th>
                                <th class="w-200"></th>
                                <th class="w-200"></th>
                                <th class="w-200"></th>
                                <th colspan="9"></th>
                                <th class="w-100"></th>
                            </tr> --}}
                        </thead>
                        <tbody class="d-none">
                        @foreach ($resultados as $resultado)
                            <tr>
                                <form method="POST" autocomplete="off">
                                    @csrf
                                    <td>
                                        <div class="{{$resultado->data_inicial ? 'label label-table label-info' : ''}}">
                                            {{$resultado['nome']}}
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="input-invisivel" name="id" id="colegas_id{{$resultado->id}}" value="{{$resultado->id}}">
                                        <div class="text-left form-group row m-0">
                                            <label for="tipo{{$resultado->id}}" class="control-label p-0">Tipo:</label>
                                            <div class="">
                                                <select id="tipo{{$resultado->id}}" name="tipo" class="form-control" autocomplete="off">
                                                    <option selected disabled>Selecione</option>
                                                    <option value="ES" {{$resultado->tipo == "ES" ? "selected" : ""}}>Trabalho no Escritório</option>
                                                    <option value="CL" {{$resultado->tipo == "CL" ? "selected" : ""}}>Clínica</option>
                                                    <option value="SH" {{$resultado->tipo == "SH" ? "selected" : ""}}>Serviços Hospitalares</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td>
                                        <div class="text-left form-group row m-0">
                                            <label for="grupo_de_risco{{$resultado->id}}" class="control-label p-0">Grupo de Disco:</label>
                                            <div class="">
                                                <select id="grupo_de_risco{{$resultado->id}}" name="grupo_de_risco" class="form-control" autocomplete="off">
                                                    <option selected disabled>Selecione</option>
                                                    <option value=0 {{$resultado->grupo_de_risco == 0 ? "selected" : ""}}>Não</option>
                                                    <option value=1 {{$resultado->grupo_de_risco == 1 ? "selected" : ""}}>Sim</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td> -->
                                    <td>
                                        <div class="text-left form-group row m-0" style="width: 100px;">
                                            <label for="telefone{{$resultado->id}}" class="control-label p-0">
                                                Telefone:
                                                <button class="btn btn-sm btn-info btn-outline font-10 btnEditTel" type="button" data-toggle="modal" data-target="#editTell" onclick="telModal({{$resultado->id}},'{{$resultado->nome}}','{{$resultado->telefone ? $resultado->telefone : null }}')"><i class="icon-note"></i></button>
                                            </label>
                                            <div class="">
                                                <p class="font-bold">{{$resultado->telefone ? $resultado->telefone : ""}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="medico{{$resultado->id}}" class="">
                                        <div class="text-left form-group row m-0">
                                            <label for="medico{{$resultado->id}}" class="control-label p-0">
                                                Médico:
                                            </label>
                                            <div class="">
                                                <input type="text" class="form-control w-200" autocomplete="off" name="medico" value="{{$resultado->medico}}" id="medico{{$resultado->id}}" placeholder="Médico">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="crm{{$resultado->id}}" class="">
                                        <div class="text-left form-group row m-0">
                                            <label for="crm{{$resultado->id}}" class="control-label p-0">
                                                CRM:
                                            </label>
                                            <div class="">
                                                <input type="text" class="form-control w-200" autocomplete="off" name="crm" value="{{$resultado->crm}}" id="crm{{$resultado->id}}" placeholder="CRM">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-left form-group row m-0">
                                            <label for="cod{{$resultado->id}}" class="control-label p-0">COD:</label>
                                            <div class="">
                                                <select id="cod{{$resultado->id}}" name="cod" class="form-control w-130" autocomplete="off" onchange="codSelect(this.value, {{$resultado->id}})" style="width: 150px;">
                                                    <option selected disabled>Selecione</option>
                                                    <option value="FA" {{$resultado->cod == "FA" ? "selected" : ""}}>FALTA</option>
                                                    <option value="AT" {{$resultado->cod == "AT" ? "selected" : ""}}>ATESTADO</option>
                                                    <option value="FE" {{$resultado->cod == "FE" ? "selected" : ""}}>FÉRIAS</option>
                                                    <option value="DE" {{$resultado->cod == "DE" ? "selected" : ""}}>DEMITIDO</option>
                                                    <option value="FO" {{$resultado->cod == "FO" ? "selected" : ""}}>FOLGA</option>
                                                    <option value="CO" {{$resultado->cod == "CO" ? "selected" : ""}}>COVID</option>
                                                    <option value="GR" {{$resultado->cod == "GR" ? "selected" : ""}}>GRUPO DE RISCO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="cid{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0 ">
                                            <label for="cid{{$resultado->id}}" class="control-label p-0">CID:</label>
                                            <div class="">
                                                <input type="text" class="form-control" autocomplete="off" name="cids_nome" value="{{$resultado->cid}}" id="cids_nome{{$resultado->id}}" placeholder="Cid" onKeyUp="getCid(this.value, {{$resultado->id}})" style="width: 150px;">
                                                <div id="listaCid{{$resultado->id}}"></div>
                                                <input type="text" class="input-invisivel" autocomplete="off" name="cids_id" value="{{$resultado->cids_id}}" id="cids_id{{$resultado->id}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="covid{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="covid{{$resultado->id}}" class="control-label p-0">COVID:</label>
                                            <div class="">
                                                <select id="covid{{$resultado->id}}" name="covid" class="form-control w-100" autocomplete="off">
                                                    <option selected disabled>Selecione</option>
                                                    <option value="Suspeito" {{$resultado->covid == "Suspeito" ? "selected" : ""}}>Suspeito</option>
                                                    <option value="Confirmado" {{$resultado->covid == "Confirmado" ? "selected" : ""}}>Confirmado</option>
                                                    <option value="Descartado" {{$resultado->covid == "Descartado" ? "selected" : ""}}>Descartado</option>
                                                    <option value="Óbito" {{$resultado->covid == "Óbito" ? "selected" : ""}}>Óbito</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="data_inicial{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="data_inicial{{$resultado->id}}" class="control-label p-0">
                                                Data inicial:
                                            </label>
                                            <div class="">
                                                <input type="date" class="form-control data_inicial w-180" autocomplete="off" name="data_inicial" value="{{$resultado->data_inicial}}" id="data_inicial{{$resultado->id}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="data_final{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="$resultado->id{{$resultado->id}}" class="control-label p-0">
                                                Data final:
                                            </label>
                                            <div class="">
                                                <input type="date" class="form-control w-180" autocomplete="off" name="data_final" value="{{$resultado->data_final}}" id="$resultado->id{{$resultado->id}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="data_dos_sintomas{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="data_dos_sintomas{{$resultado->id}}" class="control-label p-0">
                                                Data dos sintomas:
                                            </label>
                                            <div class="">
                                                <input type="date" class="form-control w-180" autocomplete="off" name="data_dos_sintomas" value="{{$resultado->data_dos_sintomas}}" id="data_dos_sintomas{{$resultado->id}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="motivo{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="motivo{{$resultado->id}}" class="control-label p-0">Motivo:</label>
                                            <div class="">
                                                <textarea class="form-control w-300" autocomplete="off" name="motivo" value="{{$resultado->motivo}}" id="motivo{{$resultado->id}}" placeholder="Motivo..." maxlength="191"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="data_do_teste{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="data_do_teste{{$resultado->id}}" class="control-label p-0">
                                                Data do teste:
                                            </label>
                                            <div class="">
                                                <input type="date" class="form-control w-180" autocomplete="off" name="data_do_teste" value="{{$resultado->data_do_teste}}" id="data_do_teste{{$resultado->id}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="tipo_do_teste{{$resultado->id}}" class="d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="tipo_do_teste{{$resultado->id}}" class="control-label p-0">
                                                Tipo do Teste:
                                            </label>
                                            <div class="">
                                                <input type="text" class="form-control w-200" autocomplete="off" name="tipo_do_teste" value="{{$resultado->tipo_do_teste}}" id="tipo_do_teste{{$resultado->id}}" placeholder="Tipo do Teste">
                                            </div>
                                        </div>
                                    </td>
                                    <td id="observacao{{$resultado->id}}" class="observacao d-none">
                                        <div class="text-left form-group row m-0">
                                            <label for="observacao{{$resultado->id}}" class="control-label p-0">Observação:</label>
                                            <div class="w-200">
                                                <textarea class="form-control" autocomplete="off" name="observacao" id="observacao{{$resultado->id}}" placeholder="Observação..." maxlength="500">{{$resultado->observacao}}</textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="10">
                                        <div class="text-right p-0">
                                            <button class="btn btn-sm btn-info btn-outline font-16 m-b-5" type="button" data-toggle="modal" data-target="#dataList" onclick="getList({{$resultado->id}},'{{$resultado->nome}}')"><i class="icon-list"></i></button>
                                            <button class="btn btn-sm btn-primary btn-outline font-16 m-b-5" type="submit"><i class="fa fa-save"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @include('forms.modal')
    </div>
</div>
@endsection

@section('script')

<script>
    $(document).ready( function () {
        var data = getUrlParameter('data');

        if(data) {
            $('#data').val(data);
            $('.data_inicial').val(data);
            $('tbody').removeClass('d-none');
        }

        let resultados = {!! json_encode($resultados) !!};

        resultados.map( function(resultado) {
            codSelect(resultado.cod, resultado.id)
        });

        $("#formDiv").removeClass('hidden');

    });

    $("form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/form",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                toastr.success(data)
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    });

    function getList(id,nome) {
        $.ajax({
            type: "GET",
            url: "/datas?id="+id,
            success: function(data){
                $("#dataList_label").html(nome);
                $("#dataList_body").html(data);

                var elems = document.querySelectorAll('.js-switch');

                for (var i = 0; i < elems.length; i++) {
                    var switchery = new Switchery(elems[i]);
                }
            }
        });
    }

    function telModal(id, nome, tel) {
        $("#editTell_label").html(nome);
        $("#editTell_input").val(tel);
        $("#editTell_id").val(id);
    }

    function editTell() {
        var tel = $("#editTell_input").val();
        var id = $("#editTell_id").val();
        $.ajax({
            type: "POST",
            url: "/editTel",
            data: {
                id: id,
                editTell_input: tel
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                toastr.success("Editado com sucesso!")
                window.location.reload(true);
            },
            error: function(error) {
                toastr.error('Erro desconhecido. Entre em contato com o nosso suporte.')
            }
        });
    }

    function handleUpdate(id,value) {
        $.ajax({
            type: "PUT",
            url: "/form",
            data: {
                id: id,
                retornou: value ? 1 : 0
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                data = JSON.parse(data);

                if(data.retornou == 1) {
                    $('#retornou'+id).find('input[type=checkbox]').prop('checked', true);
                } else {
                    $('#retornou'+id).find('input[type=checkbox]').prop('checked', false);
                }
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    }

    function handleDelete(id,value) {
        $.ajax({
            type: "DELETE",
            url: "/form",
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                data = JSON.parse(data);

                if(data == 1) {
                    $('#datalist'+id).remove();
                    toastr.success("Deletado com sucesso!")
                }
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    }


    function dataInput(value) {
        $('.data_inicial').val(value);

        var hospital = getUrlParameter('hospital') || '';

        newUrl(hospital,value);

    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    function getHospital(letras) {
        if(letras.length > 0) {
            $("#listaNome").show();
            $.ajax({
                type: "GET",
                url: "/pesquisa/hospital?hospital="+letras,
                success: function(data){
                    $("#listaNome").html(data);
                }
            });
        };
    }

    function setHospital(nome) {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        nome = JSON.parse(nome);
        newUrl(nome.id,'');
    }

    function newUrl(hospital,data) {
        var params = {
            'hospital':hospital,
            'data': data
        };
        var url = '/form?' + jQuery.param(params);
        window.location.href = url;
    };

    function getCid(letras, colegas_id) {
        if(letras.length > 0) {
            $("#listaCid"+colegas_id).show();
            $.ajax({
                type: "GET",
                url: "/pesquisa/cid?cid="+letras+"&colegas_id="+colegas_id,
                success: function(data){
                    $("#listaCid"+colegas_id).html(data);
                }
            });
        };
        $("#listaCid"+colegas_id).addClass('listaCid');
    }

    function setHCid(cid, colegas_id) {
        cids = JSON.parse(cid);
        $('#cids_nome'+colegas_id).val(cids.nome);
        $('#cids_id'+colegas_id).val(cids.id);
        $("#listaCid"+colegas_id).hide();
    }

    function codSelect(value, colegas_id) {
        $("#cid"+colegas_id).addClass('d-none');
        $("#data_dos_sintomas"+colegas_id).addClass('d-none');
        $("#data_inicial"+colegas_id).addClass('d-none');
        $("#data_final"+colegas_id).addClass('d-none');
        $("#motivo"+colegas_id).addClass('d-none');
        $("#covid"+colegas_id).addClass('d-none');
        $("#data_dos_sintomas"+colegas_id).addClass('d-none');
        $("#data_do_teste"+colegas_id).addClass('d-none');
        $("#tipo_do_teste"+colegas_id).addClass('d-none');
        $("#observacao"+colegas_id).addClass('d-none');
        if (value == 'AT') {
            $("#cid"+colegas_id).removeClass('d-none');
            $("#data_inicial"+colegas_id).removeClass('d-none');
            $("#data_final"+colegas_id).removeClass('d-none');
            $("#motivo"+colegas_id).removeClass('d-none');
        }
        else if (value == 'FE') {
            $("#data_inicial"+colegas_id).removeClass('d-none');
            $("#data_final"+colegas_id).removeClass('d-none');
        }
        else if (value == 'CO') {
            $("#covid"+colegas_id).removeClass('d-none');
            $("#data_dos_sintomas"+colegas_id).removeClass('d-none');
            $("#data_do_teste"+colegas_id).removeClass('d-none');
            $("#tipo_do_teste"+colegas_id).removeClass('d-none');
            $("#data_inicial"+colegas_id).removeClass('d-none');
            $("#data_final"+colegas_id).removeClass('d-none');
            $("#observacao"+colegas_id).removeClass('d-none');
        } else if (value == 'GR') {
            $("#data_inicial"+colegas_id).removeClass('d-none');
            $("#data_final"+colegas_id).removeClass('d-none');
            $("#observacao"+colegas_id).removeClass('d-none');
        }
    }
    $(document).ready( function () {
        const table = $('#resultado').DataTable({
            "language": {
                "url": "/Portuguese-Brasil.json"
            }
        });

        $("#searchName" ).keyup(function() {
            let value = $("#searchName").val();
            console.log(value);
            if (table.column(0).search() !== value) {
                table.column(0).search(value).draw();
                console.log(table);
            }
        });

        function searchName(value) {
            console.log('a');
        }

        const pesquisar = $('#searchName')
        pesquisar.keyup(function() {
            const value = pesquisar.val()
            console.log(value);
            table.column(0).search(`${value}`).draw()
        });

        // $( "#searchCod" ).change(function() {
        //     let value = $("#searchCod").val();
        //     console.log(value);
        //     if ( table.column(3).search() !== value ) {
        //         table
        //         .column(3)
        //         .search( 'FALTA' )
        //         .draw();
        //     }
        // });
    });
</script>

@endsection
