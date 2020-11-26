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
        <div id="dataDiv" class="form-group d-none">
            <label for="data" class="col-sm-2 control-label">Data:</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" class="w-200" autocomplete="off" id="data" name="data" onchange="dataInput(this.value)">
            </div>
        </div>
        @if($resultados->count() > 0)
            <div id="formDiv" class="col-sm-12 row p-0 hidden m-t-20 d-none">
                <div class="table-responsive">
                    <table id="resultado" class="table table-bordered table-condensed">
                        <tbody>
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
        var hospital = getUrlParameter('hospital');

        if(hospital) {
            $('#dataDiv').removeClass('d-none');
        }
        if(data) {
            $('#data').val(data);
            $('.data_inicial').val(data);
            $('#dataDiv').removeClass('d-none');
            $('#formDiv').removeClass('d-none');
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
        var hospital = getUrlParameter('hospital') || '';
        var data = getUrlParameter('data') || '';
            
        var params = {
            'hospital':hospital,
            'data': data
        };
        var url = jQuery.param(params);

        const table = $('#resultado').DataTable({
            ajax: {
                "url": `{{ url('/form/getdata?${url}') }}`,
            },
            language: {
                "url": "/Portuguese-Brasil.json"
            },
			columns: [
				{ 
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var id = row.id;
						var html = `<form method="POST" autocomplete="off">
                                    @csrf`;
						return html;
					},
                },
				{ 
                    title: "Nome",
                    data: null,
					render: (row) => {
                        var data_inicial = (row.data_inicial) ? "label label-table label-info" : "";
                        var nome = (row.nome) ? row.nome : "";
                        var id = row.id;
						var html = `<div class="${data_inicial}">${nome}</div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).css('min-width', '200px');
                    },
                },
				{
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var es = (row.tipo == "ES") ? "selected" : "";
                        var cl = (row.tipo == "CL") ? "selected" : "";
                        var sh = (row.tipo == "SH") ? "selected" : "";
                        var id = row.id;
						var html = `<input type="text" class="input-invisivel" name="id" id="colegas_id${id}" value="${id}">
                                    <div class="text-left form-group row m-0" style="width: 150px;">
                                        <label for="tipo${id}" class="control-label p-0">Tipo:</label>
                                        <div class="">
                                            <select id="tipo${id}" name="tipo" class="form-control" autocomplete="off">
                                                <option selected disabled>Selecione</option>
                                                <option value="ES" ${es}>Trabalho no Escritório</option>
                                                <option value="CL" ${cl}>Clínica</option>
                                                <option value="SH" ${sh}>Serviços Hospitalares</option>
                                            </select>
                                        </div>
                                    </div>`;
						return html;
					},
				},
				{ 
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var telefone = (row.telefone) ? row.telefone : "";
                        var nome = (row.nome) ? row.nome : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0" style="width: 100px;">
                                        <label for="telefone${id}" class="control-label p-0">
                                            Telefone:
                                            <button class="btn btn-sm btn-info btn-outline font-10 btnEditTel" type="button" data-toggle="modal" data-target="#editTell" onclick="telModal(${id},'${nome}','${telefone}')"><i class="icon-note"></i></button>
                                        </label>
                                        <div class="">
                                            <p class="font-bold">${telefone}</p>
                                        </div>
                                    </div>`;
						return html;
					},
				},
				{
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var medico = (row.medico) ? row.medico : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="medico${id}" class="control-label p-0">
                                            Médico:
                                        </label>
                                        <div class="">
                                            <input type="text" class="form-control w-200" autocomplete="off" name="medico" value="${medico}" id="medico${id}" placeholder="Médico">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'medico'+row.id);
                    },
				},
				{
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var crm = (row.crm) ? row.crm : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="crm${id}" class="control-label p-0">
                                            CRM:
                                        </label>
                                        <div class="">
                                            <input type="text" class="form-control w-200" autocomplete="off" name="crm" value="${crm}" id="crm${id}" placeholder="CRM">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'crm'+row.id);
                    },
				},
				{
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var fa = (row.cod == "FA") ? "selected" : "";
                        var at = (row.cod == "AT") ? "selected" : "";
                        var fe = (row.cod == "FE") ? "selected" : "";
                        var de = (row.cod == "DE") ? "selected" : "";
                        var fo = (row.cod == "FO") ? "selected" : "";
                        var co = (row.cod == "CO") ? "selected" : "";
                        var gr = (row.cod == "GR") ? "selected" : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="cod${id}" class="control-label p-0">COD:</label>
                                        <div class="">
                                            <select id="cod${id}" name="cod" class="form-control w-130" autocomplete="off" onchange="codSelect(this.value, ${id})" style="width: 150px;">
                                                <option selected disabled>Selecione</option>
                                                <option value="FA" ${fa}>FALTA</option>
                                                <option value="AT" ${at}>ATESTADO</option>
                                                <option value="FE" ${fe}>FÉRIAS</option>
                                                <option value="DE" ${de}>DEMITIDO</option>
                                                <option value="FO" ${fo}>FOLGA</option>
                                                <option value="CO" ${co}>COVID</option>
                                                <option value="GR" ${gr}>GRUPO DE RISCO</option>
                                            </select>
                                        </div>
                                    </div>`;
						return html;
					},
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var cid = (row.cid) ? row.cid : "";
                        var cids_id = (row.cids_id) ? row.cids_id : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0 ">
                                        <label for="cid${id}" class="control-label p-0">CID:</label>
                                        <div class="">
                                            <input type="text" class="form-control" autocomplete="off" name="cids_nome" value="${cid}" id="cids_nome${id}" placeholder="Cid" onKeyUp="getCid(this.value, ${id})" style="width: 150px;">
                                            <div id="listaCid${id}"></div>
                                            <input type="text" class="input-invisivel" autocomplete="off" name="cids_id" value="${cids_id}" id="cids_id${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'cid'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var suspeito = (row.covid == "Suspeito") ? "selected" : "";
                        var confirmado = (row.covid == "Confirmado") ? "selected" : "";
                        var descartado = (row.covid == "Descartado") ? "selected" : "";
                        var obito = (row.covid == "Óbito") ? "selected" : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="covid${id}" class="control-label p-0">COVID:</label>
                                        <div class="">
                                            <select id="covid${id}" name="covid" class="form-control w-100" autocomplete="off">
                                                <option selected disabled>Selecione</option>
                                                <option value="Suspeito" ${suspeito}>Suspeito</option>
                                                <option value="Confirmado" ${confirmado}>Confirmado</option>
                                                <option value="Descartado" ${descartado}>Descartado</option>
                                                <option value="Óbito" ${obito}>Óbito</option>
                                            </select>
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'covid'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var data_inicial = (row.data_inicial) ? row.data_inicial : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="data_inicial${id}" class="control-label p-0">
                                            Data inicial:
                                        </label>
                                        <div class="">
                                            <input type="date" class="form-control data_inicial w-180" autocomplete="off" name="data_inicial" value="${data_inicial}" id="data_inicial${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_inicial'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var data_final = (row.data_final) ? row.data_final : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="$resultado->id${id}" class="control-label p-0">
                                            Data final:
                                        </label>
                                        <div class="">
                                            <input type="date" class="form-control w-180" autocomplete="off" name="data_final" value="${data_final}" id="$resultado->id${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_final'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var data_dos_sintomas = (row.data_dos_sintomas) ? row.data_dos_sintomas : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="data_dos_sintomas${id}" class="control-label p-0">
                                            Data dos sintomas:
                                        </label>
                                        <div class="">
                                            <input type="date" class="form-control w-180" autocomplete="off" name="data_dos_sintomas" value="${data_dos_sintomas}" id="data_dos_sintomas${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_dos_sintomas'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var motivo = (row.motivo) ? row.motivo : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="motivo${id}" class="control-label p-0">Motivo:</label>
                                        <div class="">
                                            <textarea class="form-control w-300" autocomplete="off" name="motivo" value="${motivo}" id="motivo${id}" placeholder="Motivo..." maxlength="191"></textarea>
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'motivo'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var data_do_teste = (row.data_do_teste) ? row.data_do_teste : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="data_do_teste${id}" class="control-label p-0">
                                            Data do teste:
                                        </label>
                                        <div class="">
                                            <input type="date" class="form-control w-180" autocomplete="off" name="data_do_teste" value="${data_do_teste}" id="data_do_teste${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_do_teste'+row.id);
                    },
				},
				{
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var tipo_do_teste = (row.tipo_do_teste) ? row.tipo_do_teste : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="tipo_do_teste${id}" class="control-label p-0">
                                            Tipo do Teste:
                                        </label>
                                        <div class="">
                                            <input type="text" class="form-control w-200" autocomplete="off" name="tipo_do_teste" value="${tipo_do_teste}" id="tipo_do_teste${id}" placeholder="Tipo do Teste">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'tipo_do_teste'+row.id);
                    },
				},
				{
				    class: 'observacao d-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var observacao = (row.observacao) ? row.observacao : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="observacao${id}" class="control-label p-0">Observação:</label>
                                        <div class="w-200">
                                            <textarea class="form-control" autocomplete="off" name="observacao" id="observacao${id}" placeholder="Observação..." maxlength="500">${observacao}</textarea>
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'observacao'+row.id);
                    },
				},
				{
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var nome = (row.nome) ? row.nome : "";
                        var id = row.id;
						var html = `<div class="text-right p-0">
                                        <button class="btn btn-sm btn-info btn-outline font-16 m-b-5" type="button" data-toggle="modal" data-target="#dataList" onclick="getList(${id},'${nome}')"><i class="icon-list"></i></button>
                                        <button class="btn btn-sm btn-primary btn-outline font-16 m-b-5" type="submit"><i class="fa fa-save"></i></button>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('colspan', 10);
                    },
				},
				{ 
				    class: 'd-none',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var id = row.id;
						var html = `</form >`;
						return html;
					},
                },
			],
        });
    });
</script>

@endsection
