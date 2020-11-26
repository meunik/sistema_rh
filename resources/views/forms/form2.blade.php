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
                        {{-- <thead>
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
                        </thead> --}}
                        <thead>
                            {{-- <tr>Nome</tr> --}}
                            <tr>Tipo</tr>
                        </thead>
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
        // var hospital = getUrlParameter('hospital') || '';
        // var data = getUrlParameter('data') || '';
        
        // let hospital = JSON.parse('{!! json_encode($hospital) !!}');
        // let resultados = JSON.parse('{!! json_encode($resultados) !!}');
        // console.log(hospital);
        // console.log(resultados);

        const table = $('#resultado').DataTable({
            // processing: true,
            // serverSide: true,
			// ajax: `{{ url('form/getdata/${hospital}/${data}/') }}`,
			ajax: `{{ url('form2?hospital=53&data=2020-11-26') }}`,
            "language": {
                "url": "/Portuguese-Brasil.json"
            },
			columns: [
				// { data: 'nome' },
				{ 
					data: null,
					render: (row) => {
                        console.log(hospital);
                        // var es = (row == "ES") ? "selected" : "";
                        // var cl = (row == "CL") ? "selected" : "";
                        // var sh = (row == "SH") ? "selected" : "";
                        // var id = 999;
						// var html = `<input type="text" class="input-invisivel" name="id" id="colegas_id${id}" value="${id}">
                        //             <div class="text-left form-group row m-0">
                        //                 <label for="tipo${id}" class="control-label p-0">Tipo:</label>
                        //                 <div class="">
                        //                     <select id="tipo${id}" name="tipo" class="form-control" autocomplete="off">
                        //                         <option selected disabled>Selecione</option>
                        //                         <option value="ES" ${es}>Trabalho no Escritório</option>
                        //                         <option value="CL" ${cl}>Clínica</option>
                        //                         <option value="SH" ${sh}>Serviços Hospitalares</option>
                        //                     </select>
                        //                 </div>
                        //             </div>`;
						// return html;
					},
				},
				// { data: 'nome' },
				// { data: 'descricao' },
				// { data: 'documento' },
				// { data: 'valor' },
				// { 
				// 	data: 'data',
				// 	render: (data) => {
				// 		var dataTab = moment(data, "YYYY-MM-DD");
				// 		var st = dataTab.format('DD/MM/YYYY');
				// 		return st;
				// 	},
				// }
			],
        });

        // $("#searchName" ).keyup(function() {
        //     let value = $("#searchName").val();
        //     console.log(value);
        //     if (table.column(0).search() !== value) {
        //         table.column(0).search(value).draw();
        //         console.log(table);
        //     }
        // });

        // function searchName(value) {
        //     console.log('a');
        // }

        // const pesquisar = $('#searchName')
        // pesquisar.keyup(function() {
        //     const value = pesquisar.val()
        //     console.log(value);
        //     table.column(0).search(`${value}`).draw()
        // });
    });
</script>

@endsection
