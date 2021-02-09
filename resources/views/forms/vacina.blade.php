
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
                        <b class="col-sm-3 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">2ª DOSE:</b>
                        <a href="#" class="col-sm-1 col-xs-1 text-right font-18" onclick="editaVacina(['covid_laboratorio','covid_primeira_dose','covid_segunda_dose'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-3 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">3ª DOSE:</b>
                        <a href="#" class="col-sm-1 col-xs-1 text-right font-18" onclick="editaVacina(['da_primeira_dose','da_segunda_dose','da_terceira_dose'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-3 col-xs-4 row m-0 p-l-10 p-r-10 text-left b-b-1">3ª DOSE:</b>
                        <a href="#" class="col-sm-1 col-xs-1 text-right font-18" onclick="editaVacina(['hepatite_b_primeira_dise','hepatite_b_segunda_dose','hepatite_b_terceira_dose'])"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="hepatite_b_primeira_dise" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="hepatite_b_segunda_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="hepatite_b_terceira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">Dose Inicial</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">1 mês após 1ª Dose</b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-10 text-left">6 meses após 1ª Dose</b>
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
                        <b class="col-sm-5 col-xs-5 row m-0 p-l-10 p-r-10 text-left b-b-1">Valor:</b>
                        <a href="#" class="col-sm-1 col-xs-1 text-right font-18" onclick="editaVacina(['antihbs_data','antihbs_valor'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-5 col-xs-5 row m-0 p-l-10 p-r-10 text-left b-b-1">Valor:</b>
                        <a href="#" class="col-sm-1 col-xs-1 text-right font-18" onclick="editaVacina(['igg_data','igg_valor'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-10 text-left b-b-1">Dose Única:</b>
                        <a href="#" class="col-sm-2 col-xs-2 text-right font-18" onclick="editaVacina(['scr'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-10 text-left b-b-1">REFORÇO:</b>
                        <a href="#" class="col-sm-2 col-xs-2 text-right font-18" onclick="editaVacina(['scr_reforco'])"><i class="fa fa-edit"></i></a>
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-10 text-left b-b-1">REFORÇO:</b>
                        <a href="#" class="col-sm-2 col-xs-2 text-right font-18" onclick="editaVacina(['dt_reforco'])"><i class="fa fa-edit"></i></a>
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
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div class="col-sm-10 col-xs-10"></div>
                        <a href="#" class="col-sm-2 col-xs-2 text-right font-18" onclick="editaVacina(['h1n1'])"><i class="fa fa-edit"></i></a>
                    </div>
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
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div class="col-sm-10 col-xs-10"></div>
                        <a href="#" class="col-sm-2 col-xs-2 text-right font-18" onclick="editaVacina(['obervacao'])"><i class="fa fa-edit"></i></a>
                    </div>
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
        if (
            ((stringId.substr(-5) != 'valor') &&
            (stringId != 'covid_laboratorio')) &&
            (stringId != 'obervacao')
        ) {
            var momento = moment(value);
            if ((moment(value).isBefore('1900-01-01') === true) || (momento.isValid(value) === false)) return null;
        }

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
                toastr.success('Salvo com sucesso!')
                window.setTimeout(function(){location.reload()},2000)
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    }

    function editaVacina(value) {
        var num = 0;
        value.forEach(element => {
            var children = document.getElementById(element).children;
            var classe = children[0].classList;
            var numArray = children[0].classList.length - 1;
            if (classe[numArray] === 'd-none') {
                if (element === 'h1n1') $(`#b2_${element}`).removeClass('d-none');
                $(`#div_${element}`).addClass('d-none');
                $(`#b_${element}`).removeClass('d-none');
            } else {
                if (element === 'h1n1') $(`#b2_${element}`).addClass('d-none');
                $(`#div_${element}`).removeClass('d-none');
                $(`#b_${element}`).addClass('d-none');
            }
        });
    }

    function inputs(stringId, dNone) {
        var display = (dNone === true) ? 'd-none' : '';
        let id = JSON.parse('{!! json_encode($id) !!}');

        if ((stringId.substr(-5) === 'valor') || (stringId === 'covid_laboratorio')) {
            var placeholder = (stringId === 'covid_laboratorio') ? 'Laboratório' : 'Valor';
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <input type="text" class="form-control rounded" autocomplete="off" value="" id="valor${stringId}" placeholder="${placeholder}" onchange="saveVacina(${id}, '${stringId}', this.value)" maxlength="191">
                    </div>
                </div>
            </div>`;
            return html;
        } else if (stringId === 'obervacao') {
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <textarea class="form-control rounded" autocomplete="off" autocomplete="off" value="" id="obervacao${stringId}" onchange="saveVacina(${id}, '${stringId}', this.value)" placeholder="Observação..." maxlength="500"></textarea>
                    </div>
                </div>
            </div>`;
            return html;
        } else {
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <input type="date" class="form-control rounded" autocomplete="off" value="" id="date${stringId}" min="2000-01-02" onchange="saveVacina(${id}, '${stringId}', this.value)">
                    </div>
                </div>
            </div>`;
            return html;
        }
    }

    function showOrInset(data, stringId, stringIdRequisito, diasValidade) {
        var primeiraDose = moment(data[stringIdRequisito]);
        var hoje = moment();
        var mesATras = hoje.diff(primeiraDose, 'months');

        var message = '';
        function stringB(text, classe, stringId) {
            return `<b id="b_${stringId}" class="col-xs-12 m-t-10 p-l-10 font-bold ${classe}">${text}</b>`;
        }

        if ((stringIdRequisito != false)&&(mesATras >= diasValidade)) {

            var msg = (mesATras >= 2) ? `${mesATras} meses` : `${mesATras} mês`;
            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' '+`<b id="b2_${stringId}" class="col-xs-12 m-t-0 p-l-10 font-bold text-danger">Já passou ${msg} da 1ª DOSE</b>`;
            } else {
                message = stringB(`Já passou ${msg} da 1ª DOSE`, 'text-danger', stringId);
            }

        } else if ((stringIdRequisito != false)&&(mesATras === (diasValidade - 1))) {

            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' '+`<b id="b2_${stringId}" class="col-xs-12 m-t-0 p-l-10 font-bold text-warning">Falta menos de 1 mês</b>`;
            } else {
                message = stringB(`Falta menos de 1 mês`, 'text-warning', stringId);
            }

        } else if (data[stringIdRequisito] === null) {
            message = stringB(`1ª DOSE não foi dada`, 'text-davita', stringId);
        } else if (data[stringId] === null) {
            message = stringB(`Aguardando`, 'text-davita', stringId);
        } else if ((stringId.substr(-5) === 'valor') || (stringId === 'obervacao') || (stringId === 'covid_laboratorio')) {
            message = stringB(`${data[stringId]}`, 'text-davita', stringId);
        } else {
            message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId);
        }

        return message+''+inputs(stringId, true);
    }

    $(document).ready( function () {
        let id = JSON.parse('{!! json_encode($id) !!}');
        $.ajax({
            type: "GET",
            url: "/vacinaData?id="+id,
            success: function(data){
                $("#vacinaModalUnidade").html(data[0].unidade);
                $("#vacinaModalNome").html(data[0].nome);
                $("#vacinaModalCargoFuncao").html(data[0].funcao);

                $("#covid_laboratorio").html(showOrInset(data[0], "covid_laboratorio", false, false));
                $("#covid_primeira_dose").html(showOrInset(data[0], "covid_primeira_dose", false, false));
                $("#covid_segunda_dose").html(showOrInset(data[0], "covid_segunda_dose", false, false));

                $("#da_primeira_dose").html(showOrInset(data[0], "da_primeira_dose", false, false));
                $("#da_segunda_dose").html(showOrInset(data[0], "da_segunda_dose", "da_primeira_dose", 2));
                $("#da_terceira_dose").html(showOrInset(data[0], "da_terceira_dose", "da_primeira_dose", 4));

                $("#scr").html(showOrInset(data[0], "scr", false, false));

                $("#hepatite_b_primeira_dise").html(showOrInset(data[0], "hepatite_b_primeira_dise", false, false));
                $("#hepatite_b_segunda_dose").html(showOrInset(data[0], "hepatite_b_segunda_dose", "hepatite_b_primeira_dise", 1));
                $("#hepatite_b_terceira_dose").html(showOrInset(data[0], "hepatite_b_terceira_dose", "hepatite_b_primeira_dise", 6));

                $("#scr_reforco").html(showOrInset(data[0], "scr_reforco", false, false));
                $("#dt_reforco").html(showOrInset(data[0], "dt_reforco", false, false));
                $("#h1n1").html(showOrInset(data[0], "h1n1", "h1n1", 120));

                $("#antihbs_data").html(showOrInset(data[0], "antihbs_data", false, false));
                $("#antihbs_valor").html(showOrInset(data[0], "antihbs_valor", false, false));

                $("#igg_data").html(showOrInset(data[0], "igg_data", false, false));
                $("#igg_valor").html(showOrInset(data[0], "igg_valor", false, false));

                $("#obervacao").html(showOrInset(data[0], "obervacao", false, false));
            }
        });
    });
</script>
