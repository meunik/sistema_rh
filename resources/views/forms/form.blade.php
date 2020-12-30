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
        $("#cidCategoria"+colegas_id).addClass('d-none');
        $("#cidSubCategoria"+colegas_id).addClass('d-none');
        $("#data_dos_sintomas"+colegas_id).addClass('d-none');
        $("#data_inicial"+colegas_id).addClass('d-none');
        $("#dias_atestado"+colegas_id).addClass('d-none');
        $("#data_final"+colegas_id).addClass('d-none');
        $("#motivoSelectTd"+colegas_id).addClass('d-none');
        $("#motivoTd"+colegas_id).addClass('d-none');
        $("#atestadoFIle"+colegas_id).addClass('d-none');
        $("#covid"+colegas_id).addClass('d-none');
        $("#data_dos_sintomas"+colegas_id).addClass('d-none');
        $("#data_do_teste"+colegas_id).addClass('d-none');
        $("#tipo_do_teste"+colegas_id).addClass('d-none');
        $("#observacao"+colegas_id).addClass('d-none');
        $("#data_final_input"+colegas_id).attr('readonly', false);

        if (value == 'AT') {
            $("#cid"+colegas_id).removeClass('d-none');
            $("#cidCategoria"+colegas_id).removeClass('d-none');
            $("#data_inicial"+colegas_id).removeClass('d-none');
            $("#dias_atestado"+colegas_id).removeClass('d-none');
            $("#data_final"+colegas_id).removeClass('d-none');
            $("#motivoSelectTd"+colegas_id).removeClass('d-none');
            if ($("#motivoSelect"+colegas_id).val() == 3) $("#motivoTd"+colegas_id).removeClass('d-none');
            $("#atestadoFIle"+colegas_id).removeClass('d-none');
            $("#data_final_input"+colegas_id).attr('readonly', true);
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

    function salvarForm(indexLinha) {
        let submitButton = $(`#submit${indexLinha}`);
        let tr = submitButton.closest('tr');

        var date = getUrlParameter('data') || '';
        let inputData_inicial = date;

        let inputId = tr.find( "[name='id']" ).val();
        let inputTipo = tr.find( "[name='tipo']" ).val();
        let inputMedico = tr.find( "[name='medico']" ).val();
        let inputCrm = tr.find( "[name='crm']" ).val();
        let inputCod = tr.find( "[name='cod']" ).val();
        let inputCids_nome = tr.find( "[name='cids_nome']" ).val();
        let inputCidCategoria = tr.find( "[name='cidCategoria']" ).val();
        let inputCidSubCategoria = tr.find( "[name='cidSubCategoria']" ).val();
        let inputCovid = tr.find( "[name='covid']" ).val();
        let inputDias_atestado = tr.find( "[name='dias_atestado']" ).val();
        let inputData_final = tr.find( "[name='data_final']" ).val();
        let inputData_dos_sintomas = tr.find( "[name='data_dos_sintomas']" ).val();
        let inputMotivo = tr.find( "[name='motivo']" ).val();
        let inputMotivoSelect = tr.find( "[name='motivoSelect']" ).val();
        let inputData_do_teste = tr.find( "[name='data_do_teste']" ).val();
        let inputTipo_do_teste = tr.find( "[name='tipo_do_teste']" ).val();
        let inputObservacao = tr.find( "[name='observacao']" ).val();
        if (inputData_inicial) {
            let inputData_inicial = tr.find( "[name='data_inicial']" ).val();
        } else {
            let inputData_inicial = date;
        }

        let data = {
            "id": inputId,
            "tipo": inputTipo,
            "medico": inputMedico,
            "crm": inputCrm,
            "cod": inputCod,
            "cids_nome": inputCids_nome,
            "cid_categoria_id": inputCidCategoria,
            "cid_sub_categoria_id": inputCidSubCategoria,
            "covid": inputCovid,
            "data_inicial": inputData_inicial,
            "dias_atestado": inputDias_atestado,
            "data_final": inputData_final,
            "data_dos_sintomas": inputData_dos_sintomas,
            "motivo": inputMotivo,
            "motivoSelect": inputMotivoSelect,
            "data_do_teste": inputData_do_teste,
            "tipo_do_teste": inputTipo_do_teste,
            "observacao": inputObservacao,
            "data": date,
        }

        let json = data

        $.ajax({
            type: "POST",
            url: "/form",
            data: json,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                toastr.success(data)
                window.setTimeout(function(){location.reload()},2000)
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    };

    function ajaxSubCategoria(value, id) {
        if (value != null) {
            var resultado;
            $.ajax({
                type: "GET",
                url: "/pesquisa/cidSubCategoria",
                data: {id: value},
                dataType: "JSON",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    resultado = data;
                },
                error: function(error) {
                    resultado = null;
                }
            });
        } else {
            var resultado = null;
        }
        return resultado;
    };

    function cidSubCategoria(value, id, cidSubCatId) {
        $("#cidSubCategoriaSelect"+id).children().remove();
        $(`#cidSubCategoriaSelect${id}`).append(`<option selected disabled>Selecione</option>`);

        $("#cidSubCategoria"+id).removeClass('d-none');

        var resultado = ajaxSubCategoria(value, id);

        var selected;

        resultado.forEach(element => {
            if (element.id == cidSubCatId) {
                $(`#cidSubCategoriaSelect${id}`).append(`<option value="${element.id}" selected>(${element.categoria}) ${element.nome}</option>`);
            } else {
                $(`#cidSubCategoriaSelect${id}`).append(`<option value="${element.id}">(${element.categoria}) ${element.nome}</option>`);
            };
        });
    };

    function optionsSubCategoria(categoriaId, id, subCategoriaId) {
        var options;
        var resultado = ajaxSubCategoria(categoriaId, id);
        if (resultado != null) {
            resultado.forEach(element => {
                if (element.id == subCategoriaId) {
                    options = options+`<option value="${element.id}" selected>(${element.categoria}) ${element.nome}</option>`;
                } else {
                    options = options+`<option value="${element.id}">(${element.categoria}) ${element.nome}</option>`;
                };
            });
        }
        return options;
    };

    function cidMotivo(value, colegas_id) {
        if (value == 3) {
            $("#motivoTd"+colegas_id).removeClass('d-none');
        } else {
            $("#motivoTd"+colegas_id).addClass('d-none');
        }
    };

    function atestadoFIle(id) {
        $("#atestadoFIle_id").val(id);
        $("#atestadoNomeFIle_input").val(null);
        $("#atestadoFIle_input").val(null);
    };

    function atestadoFileSubmit() {
        var formData = new FormData($("#atestadoFIleForm").get(0));

        $.ajax({
            async: true,
            type: "POST",
            url: "/atestadoFile",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                toastr.success("Salvo com sucesso!")
                window.setTimeout(function(){location.reload()},2000)
            },
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    };

    function atestadoDataFinal(value, id) {
        if (value < 1) {
            toastr.error('Valor deve ser 1 ou superior!');
        } else {
            var data_inicial = $('#data_inicial_input'+id).val();
            var dias = value - 1;
            var data_final = moment(data_inicial, "YYYY-MM-DD").add(dias, 'days').format('YYYY-MM-DD');
            $("#data_final_input"+id).val(data_final);
        }
    };

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
				{/*nome*/
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
				{/*tipo*/
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
				{/*telefone*/
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
				{/*medico*/
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
				{/*crm*/
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
				{/*cod*/
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
				{/*cidCategoria*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var cid = (row.cid) ? row.cid : "";
                        var cids_id = (row.cids_id) ? row.cids_id : "";
                        var cid_cat = (row.cid_categoria_id) ? row.cid_categoria_id : "0";
                        var selected = {cid_cat: null};
                        selected[`${cid_cat}`] = "selected";
                        var id = row.id;
                        var html1 = `<div class="text-left form-group row m-0">
                                        <label for="cidCategoria${id}" class="control-label p-0">CID Categoria:</label>
                                        <div class="">
                                            <select id="cidCategoria${id}" name="cidCategoria" class="form-control w-130" autocomplete="off" style="width: 250px;" onchange="cidSubCategoria(this.value, ${id}, null)">
                                                <option selected disabled>Selecione</option>
                                                <option value="1" ${selected[1]}>(A00 - B99) Algumas doenças infecciosas e parasitárias</option>
                                                <option value="2" ${selected[2]}>(C00 - D48) Neoplasias [tumores]</option>
                                                <option value="3" ${selected[3]}>(D50 - D89) Doenças do sangue e dos órgãos hematopoéticos e alguns transtornos imunitários</option>
                                                <option value="4" ${selected[4]}>(E00 - E90) Doenças endócrinas, nutricionais e metabólicas</option>
                                                <option value="5" ${selected[5]}>(F00 - F99) Transtornos mentais e comportamentais</option>
                                                <option value="6" ${selected[6]}>(G00 - G99) Doenças do sistema nervoso</option>
                                                <option value="7" ${selected[7]}>(H00 - H59) Doenças do olho e anexos</option>
                                                <option value="8" ${selected[8]}>(H60 - H95) Doenças do ouvido e da apófise mastóide</option>
                                                <option value="9" ${selected[9]}>(I00 - I99) Doenças do aparelho circulatório</option>
                                                <option value="10" ${selected[10]}>(J00 - J99) Doenças do aparelho respiratório</option>
                                                <option value="11" ${selected[11]}>(K00 - K93) Doenças do aparelho digestivo</option>
                                                <option value="12" ${selected[12]}>(L00 - L99) Doenças da pele e do tecido subcutâneo</option>
                                                <option value="13" ${selected[13]}>(M00 - M99) Doenças do sistema osteomuscular e do tecido conjuntivo</option>
                                                <option value="14" ${selected[14]}>(N00 - N99) Doenças do aparelho geniturinário</option>
                                                <option value="15" ${selected[15]}>(O00 - O99) Gravidez, parto e puerpério</option>
                                                <option value="16" ${selected[16]}>(P00 - P96) Algumas afecções originadas no período perinatal</option>
                                                <option value="17" ${selected[17]}>(Q00 - Q99) Malformações congênitas, deformidades e anomalias cromossômicas</option>
                                                <option value="18" ${selected[18]}>(R00 - R99) Sintomas, sinais e achados anormais de exames clín… de laboratório, não classificados em outra parte</option>
                                                <option value="19" ${selected[19]}>(S00 - T98) Lesões, envenenamento e algumas outras consequências de causas externas</option>
                                                <option value="20" ${selected[20]}>(V01 - Y98) Causas externas de morbidade e de mortalidade</option>
                                                <option value="21" ${selected[21]}>(Z00 - Z99) Fatores que influenciam o estado de saúde e o contato com os serviços de saúde</option>
                                                <option value="22" ${selected[22]}>(U04 - U99) Códigos para propósitos especiais</option>
                                            </select>
                                        </div>
                                    </div>`;

						var html2 = `<div class="text-left form-group row m-0 ">
                                        <label for="cid${id}" class="control-label p-0">CID:</label>
                                        <div class="">
                                            <input type="text" class="form-control" autocomplete="off" name="cids_nome" value="${cid}" id="cids_nome${id}" placeholder="Cid" onKeyUp="getCid(this.value, ${id})" style="width: 150px;">
                                            <div id="listaCid${id}"></div>
                                            <input type="text" class="input-invisivel" autocomplete="off" name="cids_id" value="${cids_id}" id="cids_id${id}">
                                        </div>
                                    </div>`;

                        if (row.cids_id != null) {
						    return html2;
                        } else {
						    return html1;
                        }
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'cidCategoria'+row.id);
                        if (row.cod != 'AT') $(td).attr('class', 'd-none')
                    },
				},
				{/*cidSubCategoria*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var id = row.id;
                        if (row.cod === 'AT') var options = optionsSubCategoria(row.cid_categoria_id, row.id, row.cid_sub_categoria_id);

                        var html = `<div class="text-left form-group row m-0">
                                        <label for="cidSubCategoria${id}" class="control-label p-0">CID Subcategoria:</label>
                                        <div class="">
                                            <select id="cidSubCategoriaSelect${id}" name="cidSubCategoria" class="form-control w-130" autocomplete="off" style="width: 250px;">
                                                <option selected disabled>Selecione</option>`+options+
                                            `</select>
                                        </div>
                                    </div>`;
                        return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'cidSubCategoria'+row.id);
                        if (row.cid_categoria_id === null) $(td).attr('class', 'd-none')
                    },
				},
				{/*covid*/
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
                        if (row.cod != 'CO') $(td).attr('class', 'd-none')
                    },
				},
				{/*data_inicial*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var data_inicial = (row.data_inicial) ? row.data_inicial : moment().format("YYYY-MM-DD");
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="data_inicial_input${id}" class="control-label p-0">
                                            Data inicial:
                                        </label>
                                        <div class="">
                                            <input type="date" class="form-control data_inicial w-180" autocomplete="off" name="data_inicial" value="${data_inicial}" id="data_inicial_input${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_inicial'+row.id);
                        switch (row.cod) {
                            case 'AT': break;
                            case 'FE': break;
                            case 'CO': break;
                            case 'GR': break;
                            default:
                                $(td).attr('class', 'd-none')
                                break;
                        }
                    },
				},
				{/*dias_atestado*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var dias_atestado = (row.dias_atestado) ? row.dias_atestado : '';
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="dias_atestado_input${id}" class="control-label p-0">
                                            Dias atestado:
                                        </label>
                                        <div class="">
                                            <input type="number" min="1" max="370" step="1" class="form-control" autocomplete="off" name="dias_atestado" value="${dias_atestado}" id="dias_atestado_input${id}" style="width: 80px;" onchange="atestadoDataFinal(this.value, ${id})">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'dias_atestado'+row.id);
                        if (row.cod != 'AT') $(td).attr('class', 'd-none');
                    },
				},
				{/*data_final*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var readonly = (row.cod === 'AT') ? 'readonly' : '';
                        var data_final = (row.data_final) ? row.data_final : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="data_final_input${id}" class="control-label p-0">
                                            Data final:
                                        </label>
                                        <div class="">
                                            <input type="date" ${readonly} class="form-control w-180" autocomplete="off" name="data_final" value="${data_final}" id="data_final_input${id}">
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'data_final'+row.id);
                        switch (row.cod) {
                            case 'AT': break;
                            case 'FE': break;
                            case 'CO': break;
                            case 'GR': break;
                            default:
                                $(td).attr('class', 'd-none')
                                break;
                        }
                    },
				},
				{/*data_dos_sintomas*/
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
                        if (row.cod != 'CO') $(td).attr('class', 'd-none')
                    },
				},
				{/*motivoSelect*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var motivoSelect = (row.motivoSelect) ? row.motivoSelect : "";
                        var selected = {motivoSelect: null};
                        selected[`${motivoSelect}`] = "selected";
                        var id = row.id;

                        var html = `<div class="text-left form-group row m-0">
                                        <label for="motivoSelect${id}" class="control-label p-0">Motivo:</label>
                                        <div class="">
                                            <select id="motivoSelect${id}" name="motivoSelect" class="form-control w-130" autocomplete="off" style="width: 250px;" onchange="cidMotivo(this.value, ${id})">
                                                <option selected disabled>Selecione</option>
                                                <option value="1" ${selected[1]}>Acidente Trabalho ou Doença Ocupacional</option>
                                                <option value="2" ${selected[2]}>Licença Maternidade</option>
                                                <option value="3" ${selected[3]}>Outros</option>
                                            </select>
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'motivoSelectTd'+row.id);
                        if (row.cod != 'AT') $(td).attr('class', 'd-none')
                    },
				},
				{/*motivo*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var motivo = (row.motivo) ? row.motivo : "";
                        var id = row.id;
						var html = `<div class="text-left form-group row m-0">
                                        <label for="motivo${id}" class="control-label p-0">Outros:</label>
                                        <div class="">
                                            <textarea class="form-control w-300" autocomplete="off" name="motivo" id="motivo${id}" placeholder="Outros motivos..." maxlength="191">${motivo}</textarea>
                                        </div>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'motivoTd'+row.id);
                        if ((row.cod != 'AT') || (row.motivoSelect != 3)) $(td).attr('class', 'd-none')
                    },
				},
				{/*atestadoFIle*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var id = row.data_id;
                        // var id = row.id;
						var html = `<div class="text-left p-0">
                                        <label for="atestadoFIleLabel${id}" class="col-sm-12 control-label p-0">Adicionar arquivo:</label>
                                        <button id="atestadoFIleLabel${id}" class="btn btn-sm btn-info btn-outline font-16 m-b-5" type="button" data-toggle="modal" data-target="#atestadoFIle" onclick="atestadoFIle('${id}')">
                                            <i class="fa fa-plus"></i> Arquivo <i class="fa fa-file"></i>
                                        </button>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('id', 'atestadoFIle'+row.id);
                        if (row.cod != 'AT') $(td).attr('class', 'd-none')
                    },
				},
				{/*data_do_teste*/
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
                        if (row.cod != 'CO') $(td).attr('class', 'd-none')
                    },
				},
				{/*tipo_do_teste*/
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
                        if (row.cod != 'CO') $(td).attr('class', 'd-none')
                    },
				},
				{/*observacao*/
				    class: 'observacao',
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
                        switch (row.cod) {
                            case 'CO': break;
                            case 'GR': break;
                            default:
                                $(td).attr('class', 'd-none')
                                break;
                        }
                    },
				},
				{/*submit*/
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row, type, full, meta) => {
                        let indexLinha = meta.row
                        var nome = (row.nome) ? row.nome : "";
                        var id = row.id;
						var html = `<div class="text-right p-0">
                                        <button class="btn btn-sm btn-info btn-outline font-16 m-b-5" type="button" data-toggle="modal" data-target="#dataList" onclick="getList(${id},'${nome}')"><i class="icon-list"></i></button>
                                        <button id="submit${indexLinha}" class="btn btn-sm btn-primary btn-outline font-16 m-b-5" type="button" onclick="salvarForm(${indexLinha})"><i class="fa fa-save"></i></button>
                                    </div>`;
						return html;
					},
                    createdCell: function (td, row) {
                        $(td).attr('colspan', 15);
                        $(td).attr('id', 'submitTr'+row.id);
                    },
				},
			],
        });

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

        $("#formDiv").removeClass('hidden');
    });
</script>

@endsection
