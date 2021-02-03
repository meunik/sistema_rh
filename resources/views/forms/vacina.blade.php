
{{-- @include('header') --}}

<div id="formDivVacina" class="col-sm-12 row p-0 m-t-20">
    <div>
        <div class="row p-b-10">
            <div class="col-sm-12 row m-0 text-left">
                <b class="col-sm-3 m-0">Unidade:</b>
                <div id="vacinaModalUnidade" class="col-sm-9 m-0"></div>
            </div>
            <div class="col-sm-12 row m-0 text-left">
                <b class="col-sm-3 m-0">Nome:</b>
                <div id="vacinaModalNome" class="col-sm-9 m-0"></div>
            </div>
            <div class="col-sm-12 row m-0 text-left">
                <b class="col-sm-3 m-0">Cargo/Função:</b>
                <div id="vacinaModalCargoFuncao" class="col-sm-9 m-0"></div>
            </div>
        </div>

        <div class="col-sm-8 row p-0 m-t-20">
            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        COVID
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">Laboratório:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">1ª DOSE:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">2ª DOSE:</b>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="covid_laboratorio" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="covid_primeira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="covid_segunda_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        DUPLA ADULTO (DT - Difteria e Tétano)
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">1ª DOSE:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">2ª DOSE:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">3ª DOSE:</b>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="da_primeira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="da_segunda_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="da_terceira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">Dose Inicial</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">2 meses após 1ª Dose</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">4 meses após 1ª Dose</b>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        HEPATITE B (Anti HBS)
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">1ª DOSE:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">2ª DOSE:</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">3ª DOSE:</b>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="hepatite_b_primeira_dise" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="hepatite_b_segunda_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="hepatite_b_terceira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        AntiHBS
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">Data:</b>
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">Valor:</b>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="antihbs_data" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                        <div id="antihbs_valor" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        IGG
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">Data:</b>
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">Valor:</b>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="igg_data" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                        <div id="igg_valor" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 row p-0 m-t-20">
            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        SCR (Tríplice Viral)
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left b-b-1">UNICA:</b>
                    </div>
                    <div id="scr" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">Dose Única</b>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        SCR
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left b-b-1">REFORÇO:</b>
                    </div>
                    <div id="scr_reforco" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        DT
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left b-b-1">REFORÇO:</b>
                    </div>
                    <div id="dt_reforco" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">a cada 10 anos</b>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        H1N1 (Influenza)
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div id="h1n1" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">Dose Anual</b>
                </div>
            </div>

            <div class="col-sm-12 row p-b-10">
                <div class="col-sm-12 col-xs-12 row m-0 p-0">
                    <h4 class="col-sm-12 col-xs-12 m-0 p-l-0 p-r-0 font-semibold text-center">
                        Observações
                    </h4>
                </div>
                <div class="col-xs-12 row p-10 borda-1 rounded box-shadow-vacinas borda-color-vacina">
                    <div id="obervacao" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- @include('scripts')
<script src="{{URL::asset('js/getUrlParameter.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/newUrl.js')}}" type="text/javascript"></script> --}}

<script>

    function saveVacina(id, stringId, value) {
        console.log(id);
        console.log(stringId);
        console.log(value);
        let data = {
            "id": id,
            "stringId": stringId,
            "value": value,
        }

        let json = data

        $.ajax({
            type: "POST",
            url: "/vacinaSave",
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
    }

    /**
     * Varifica se passou a data da dose anterior
     * return true = passou da validade
     * return false = ainda não passou
    */
    function varificaPassouDataValidade(diasValidade, stringIdRequisito, dataDoseAnterior) {
        var mesAtras = moment().subtract(diasValidade, 'days');

        if ((stringIdRequisito != false)&&(moment(dataDoseAnterior).isBefore(mesAtras, 'day') != false)) {
            var hasError = 'has-error rounded-6';
            var message = `<label class="font-bold text-danger p-b-0 p-t-0 p-l-5 p-r-5">Já passou de ${diasValidade} dias da 1ª DOSE</label>`;
        } else {
            var hasError = '';
            var message = '';
        }
        return {
            'hasError': hasError,
            'message': message
        };
    }

    function showOrInset(data, stringId, stringIdRequisito, diasValidade) {
        var id = data.colega_id;
        if (data[stringId] != undefined) {
            if (
                (stringId === 'vacinaModalUnidade') ||
                (stringId === 'vacinaModalNome') ||
                (stringId === 'vacinaModalCargoFuncao')
            ) {
                return data[stringId];
            } else {
                if ((stringId.substr(-5) === 'valor') || (stringId === 'obervacao')) {
                    var html = `<b class="col-xs-12 m-t-10 p-l-10 font-bold text-davita">${data[stringId]}</b>`;
                    return html;
                } else {
                    var html = `<b class="col-xs-12 m-t-10 p-l-10 font-bold text-davita">${moment(data[stringId]).format('DD/MM/YYYY')}</b>`;
                    return html;
                }
            }
        } else {
            if (stringId.substr(-5) === 'valor') {
                var valid = varificaPassouDataValidade(diasValidade, stringIdRequisito, data[stringIdRequisito]);
                var html = `<div class="text-left form-group row m-0 p-5">
                    <div id="div_valor${stringId}" class="text-left form-group row m-0 m-t-5">
                        ${valid.message}
                        <div class="${valid.hasError}">
                            <input type="text" class="form-control rounded" autocomplete="off" value="" id="valor${stringId}" placeholder="Valor" onchange="saveVacina(${id}, '${stringId}', this.value)">
                        </div>
                    </div>
                </div>`;
                return html;
            } else if (stringId === 'obervacao') {
                var valid = varificaPassouDataValidade(diasValidade, stringIdRequisito, data[stringIdRequisito]);
                var html = `<div class="text-left form-group row m-0 p-5">
                    <div id="div_valor${stringId}" class="text-left form-group row m-0 m-t-5">
                        ${valid.message}
                        <div class="${valid.hasError}">
                            <textarea class="form-control rounded" autocomplete="off" autocomplete="off" value="" id="valor${stringId}" onchange="saveVacina(${id}, '${stringId}', this.value)" placeholder="Observação..." maxlength="500"></textarea>
                        </div>
                    </div>
                </div>`;
                return html;
            } else {
                var valid = varificaPassouDataValidade(diasValidade, stringIdRequisito, data[stringIdRequisito]);
                var html = `<div class="text-left form-group row m-0 p-5">
                    <div id="div_date${stringId}" class="text-left form-group row m-0 m-t-5">
                        ${valid.message}
                        <div class="${valid.hasError}">
                            <input type="date" class="form-control rounded" autocomplete="off" value="" id="date${stringId}" onchange="saveVacina(${id}, '${stringId}', this.value)">
                        </div>
                    </div>
                </div>`;
                return html;
            }
        }
    }

    function vacina(data) {

        $("#vacinaModalUnidade").html(data.unidade);
        $("#vacinaModalNome").html(data.nome);
        $("#vacinaModalCargoFuncao").html(data.funcao);

        $("#covid_laboratorio").html(showOrInset(data, "covid_laboratorio", false, false));
        $("#covid_primeira_dose").html(showOrInset(data, "covid_primeira_dose", false, false));
        $("#covid_segunda_dose").html(showOrInset(data, "covid_segunda_dose", false, false));

        $("#da_primeira_dose").html(showOrInset(data, "da_primeira_dose", false, false));
        $("#da_segunda_dose").html(showOrInset(data, "da_segunda_dose", "da_primeira_dose", 60));
        $("#da_terceira_dose").html(showOrInset(data, "da_terceira_dose", "da_primeira_dose", 120));

        $("#scr").html(showOrInset(data, "scr", false, false));

        $("#hepatite_b_primeira_dise").html(showOrInset(data, "hepatite_b_primeira_dise", false, false));
        $("#hepatite_b_segunda_dose").html(showOrInset(data, "hepatite_b_segunda_dose", "hepatite_b_primeira_dise", 30));
        $("#hepatite_b_terceira_dose").html(showOrInset(data, "hepatite_b_terceira_dose", "hepatite_b_primeira_dise", 90));

        $("#scr_reforco").html(showOrInset(data, "scr_reforco", false, false));
        $("#dt_reforco").html(showOrInset(data, "dt_reforco", false, false));
        $("#h1n1").html(showOrInset(data, "h1n1", "h1n1", 304));

        $("#antihbs_data").html(showOrInset(data, "antihbs_data", false, false));
        $("#antihbs_valor").html(showOrInset(data, "antihbs_valor", false, false));

        $("#igg_data").html(showOrInset(data, "igg_data", false, false));
        $("#igg_valor").html(showOrInset(data, "igg_valor", false, false));

        $("#obervacao").html(showOrInset(data, "obervacao", false, false));
    }

    function vacinaModa(id) {
        $.ajax({
            type: "GET",
            url: "/vacinaData?id="+id,
            success: function(data){
                vacina(data[0]);
            }
        });
    }

    $(document).ready( function () {
        let id = JSON.parse('{!! json_encode($id) !!}');
        vacinaModa(id)
    });
</script>
