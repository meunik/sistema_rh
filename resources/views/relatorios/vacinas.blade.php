@extends('layout')

@section('content')
<div class="container-fluid m-l-10 m-r-10">
    <h3 class="box-title font-bold">Vacinas</h3>
    <hr>

    <div class="form-group">
        <h3 class="text-center"><i class="fa fa-building-o"></i></h3>
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

    <div class="col-sm-12 m-b-30">
    </div>
    <hr>

    <div id="vacinaDiv" class="col-sm-12 row p-0 d-none">
        <div class="col-sm-12 table-responsive p-0 p-r-10">
            <table id="resultado" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center font-12 p-3">Nome</th>
                        <th class="text-center font-12 p-3">Unidade</th>
                        <th class="text-center font-12 p-3">Cargo/Função</th>
                        <th class="text-center font-12 p-3">COVID<br>(Laboratorio)</th>
                        <th class="text-center font-12 p-3">COVID<br>(1ª Dose)</th>
                        <th class="text-center font-12 p-3">COVID<br>(2ª Dose)</th>
                        <th class="text-center font-12 p-3">DUPLA ADULTO<br>(1ª Dose)</th>
                        <th class="text-center font-12 p-3">DUPLA ADULTO<br>(2ª Dose)</th>
                        <th class="text-center font-12 p-3">DUPLA ADULTO<br>(3ª Dose)</th>
                        <th class="text-center font-12 p-3">SCR-Tríplice Viral (Dose Única)</th>
                        <th class="text-center font-12 p-3">HEPATITE B<br>(1ª Dose)</th>
                        <th class="text-center font-12 p-3">HEPATITE B<br>(2ª Dose)</th>
                        <th class="text-center font-12 p-3">HEPATITE B<br>(3ª Dose)</th>
                        <th class="text-center font-12 p-3">SCR<br>(Reforço)</th>
                        <th class="text-center font-12 p-3">DT<br>(Reforço)</th>
                        <th class="text-center font-12 p-3">H1N1<br>(Influenza)</th>
                        <th class="text-center font-12 p-3">AntiHBS<br>(Data)</th>
                        <th class="text-center font-12 p-3">AntiHBS<br>(Valor)</th>
                        <th class="text-center font-12 p-3">IGG<br>(Data)</th>
                        <th class="text-center font-12 p-3">IGG<br>(Valor)</th>
                        <th class="text-center font-12 p-3">Observações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{URL::asset('js/getUrlParameter.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/newUrl.js')}}" type="text/javascript"></script>

<script>

    function dataInput(value) {
        var hospital = getUrlParameter('hospital') || '';
        newUrl(hospital,value);
    }

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
        nome = JSON.parse(nome);
        var params = {
            'hospital':nome.id
        };
        newUrl(params);
    }

    function showOrInset(data, stringId, stringIdRequisito, diasValidade) {
        var primeiraDose = moment(data[stringIdRequisito]);
        var hoje = moment();
        var mesATras = hoje.diff(primeiraDose, 'months');

        var message = '';
        function stringB(text, classe, stringId) {
            return `<b class="m-0 p-0 font-bold ${classe}">${text}</b>`;
        }

        if ((stringIdRequisito != false)&&(mesATras >= diasValidade)) {

            var msg = (mesATras >= 2) ? `${mesATras} meses` : `${mesATras} mês`;
            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' '+stringB(`(Já passou ${msg} da 1ª DOSE)`, 'text-danger', stringId);
            } else {
                message = stringB(`Já passou ${msg} da 1ª DOSE`, 'text-danger', stringId);
            }

        } else if ((stringIdRequisito != false)&&(mesATras === (diasValidade - 1))) {

            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' ('+stringB(`Falta menos de 1 mês`, 'text-warning', stringId)+')';
            } else {
                message = stringB(`Falta menos de 1 mês`, 'text-warning', stringId);
            }

        } else if (data[stringIdRequisito] === null) {
            message = stringB(`1ª DOSE não foi dada`, 'text-davita', stringId);
        } else if (data[stringId] === null) {
            message = 'Aguardando';
            // message = stringB(`Aguardando`, 'text-davita', stringId);
        } else if ((stringId.substr(-5) === 'valor') || (stringId === 'obervacao') || (stringId === 'covid_laboratorio')) {
            message = stringB(`${data[stringId]}`, 'text-davita', stringId);
        } else {
            message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId);
        }

        return message;
    }

    $(document).ready( function () {
        var id = getUrlParameter('hospital');

        if(id) $('#vacinaDiv').removeClass('d-none');

        const table = $('#resultado').DataTable({
            ajax: { "url": `/vacinaDataTable?id=${id}` },
            language: { "url": "/Portuguese-Brasil.json" },
            info: false,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'pdf' ],
            columns: [
                {/*nome*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var nome = (row.nome) ? row.nome : "";
						return `<div class="label label-table text-dark font-12 p-0">${nome}</div>`;
					},
                },
                {/*unidade*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var unidade = (row.unidade) ? row.unidade : "";
						return `<div class="label label-table text-dark font-12 p-0">${unidade}</div>`;
					},
                },
                {/*funcao*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var funcao = (row.funcao) ? row.funcao : "";
						return `<div class="label label-table text-dark font-12 p-0">${funcao}</div>`;
					},
                },
                {/*covid_laboratorio*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "covid_laboratorio", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*covid_primeira_dose*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "covid_primeira_dose", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*covid_segunda_dose*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "covid_segunda_dose", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*da_primeira_dose*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "da_primeira_dose", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*da_segunda_dose*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "da_segunda_dose", "da_primeira_dose", 2);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*da_terceira_dose*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "da_terceira_dose", "da_primeira_dose", 4);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*scr*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "scr", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*hepatite_b_primeira_dise*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "hepatite_b_primeira_dise", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*hepatite_b_segunda_dose*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "hepatite_b_segunda_dose", "hepatite_b_primeira_dise", 1);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*hepatite_b_terceira_dose*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "hepatite_b_terceira_dose", "hepatite_b_primeira_dise", 6);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*scr_reforco*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "scr_reforco", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*dt_reforco*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "dt_reforco", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*h1n1*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "h1n1", "h1n1", 120);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*antihbs_data*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "antihbs_data", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*antihbs_valor*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "antihbs_valor", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*igg_data*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "igg_data", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*igg_valor*/
                    className: 'text-center b-r-vacina',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
						var html = showOrInset(row, "igg_valor", false, false);
						return `<div class="label label-table text-dark font-12 p-0">${html}</div>`;
					},
                },
                {/*obervacao*/
                    className: 'text-center',
					data: null,
				    orderable: false,
				    searchable: false,
					render: (row) => {
                        var obervacao = (row.obervacao) ? row.obervacao : "";
						return `<div class="label label-table text-dark font-12 p-0">${obervacao}</div>`;
					},
                },
            ],
        });
    });
</script>
@endsection
