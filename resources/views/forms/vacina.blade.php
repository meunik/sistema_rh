{{-- descomentar para manutenções --}}
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
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            Laboratório:
                            <button type="button" class="covid_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('covid_laboratorio', 'covid')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            1ª DOSE:
                            <button type="button" class="covid_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('covid_primeira_dose', 'covid')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-3 col-xs-3 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            2ª DOSE:
                            <button type="button" class="covid_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('covid_segunda_dose', 'covid')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="covid_edit" class="col-sm-1 col-xs-1 p-0 text-right">
                        </div>
                        <div id="covid_cancel" class="col-sm-1 col-xs-1 p-0 text-right  d-none">
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="covid_laboratorio" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="covid_primeira_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                        <div id="covid_segunda_dose" class="col-sm-4 col-xs-4 row m-0 p-0 text-left"></div>
                    </div>
                    <div id="covid_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
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
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            1ª DOSE:
                            <button type="button" class="da_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('da_primeira_dose', 'da')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            2ª DOSE:
                            <button type="button" class="da_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('da_segunda_dose', 'da')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-3 col-xs-3 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            3ª DOSE:
                            <button type="button" class="da_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('da_terceira_dose', 'da')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="da_edit" class="col-sm-1 col-xs-1 p-0 text-right">
                        </div>
                        <div id="da_cancel" class="col-sm-1 col-xs-1 p-0 text-right  d-none">
                        </div>
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
                    <div id="da_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
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
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            1ª DOSE:
                            <button type="button" class="hepatite_b_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('hepatite_b_primeira_dise', 'hepatite_b')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-4 col-xs-4 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            2ª DOSE:
                            <button type="button" class="hepatite_b_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('hepatite_b_segunda_dose', 'hepatite_b')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-3 col-xs-3 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            3ª DOSE:
                            <button type="button" class="hepatite_b_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('hepatite_b_terceira_dose', 'hepatite_b')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="hepatite_b_edit" class="col-sm-1 col-xs-1 p-0 text-right">
                        </div>
                        <div id="hepatite_b_cancel" class="col-sm-1 col-xs-1 p-0 text-right  d-none">
                        </div>
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
                    <div id="hepatite_b_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
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
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">
                            Data:
                            <button type="button" class="antihbs_apagar font-11 text-danger btn-link d-none" onclick="apagaVacina('antihbs_data', 'antihbs')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-5 col-xs-5 row m-0 p-l-10 p-r-10 text-left b-b-1">
                            Valor:
                            <button type="button" class="antihbs_apagar font-11 text-danger btn-link d-none" onclick="apagaVacina('antihbs_valor', 'antihbs')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="antihbs_edit" class="col-sm-1 col-xs-1 p-0 text-right">
                        </div>
                        <div id="antihbs_cancel" class="col-sm-1 col-xs-1 p-0 text-right  d-none">
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="antihbs_data" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                        <div id="antihbs_valor" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                    </div>
                    <div id="antihbs_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
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
                        <b class="col-sm-6 col-xs-6 row m-0 p-l-10 p-r-10 text-left b-b-1">
                            Data:
                            <button type="button" class="igg_apagar font-11 text-danger btn-link d-none" onclick="apagaVacina('igg_data', 'igg')"><i class="fa fa-times"></i> Apagar</button>
                        </b>
                        <b class="col-sm-5 col-xs-5 row m-0 p-l-10 p-r-10 text-left b-b-1">
                            Valor:
                            <button type="button" class="igg_apagar font-11 text-danger btn-link d-none" onclick="apagaVacina('igg_valor', 'igg')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="igg_edit" class="col-sm-1 col-xs-1 p-0 text-right">
                        </div>
                        <div id="igg_cancel" class="col-sm-1 col-xs-1 p-0 text-right  d-none">
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row m-0 p-0">
                        <div id="igg_data" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                        <div id="igg_valor" class="col-sm-6 col-xs-6 row m-0 p-0 text-left"></div>
                    </div>
                    <div id="igg_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            Dose Única:
                            <button type="button" class="scr_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('scr', 'scr')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="scr_edit" class="col-sm-2 col-xs-2 p-0 text-right">
                        </div>
                        <div id="scr_cancel" class="col-sm-2 col-xs-2 p-0 text-right d-none">
                        </div>
                    </div>
                    <div id="scr" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">Dose Única</b>
                    <div id="scr_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
                    </div>
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            REFORÇO:
                            <button type="button" class="scr_reforco_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('scr_reforco', 'scr_reforco')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="scr_reforco_edit" class="col-sm-2 col-xs-2 p-0 text-right">
                        </div>
                        <div id="scr_reforco_cancel" class="col-sm-2 col-xs-2 p-0 text-right d-none">
                        </div>
                    </div>
                    <div id="scr_reforco" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <div id="scr_reforco_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
                    </div>
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
                        <b class="col-sm-10 col-xs-10 row m-0 p-l-10 p-r-0 text-left b-b-1">
                            REFORÇO:
                            <button type="button" class="dt_reforco_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('dt_reforco', 'dt_reforco')"><i class="fa fa-times"></i> Apagar</button>
                        </b>

                        <div id="dt_reforco_edit" class="col-sm-2 col-xs-2 p-0 text-right">
                        </div>
                        <div id="dt_reforco_cancel" class="col-sm-2 col-xs-2 p-0 text-right d-none">
                        </div>
                    </div>
                    <div id="dt_reforco" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">a cada 10 anos</b>
                    <div id="dt_reforco_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
                    </div>
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
                        <div class="col-sm-10 col-xs-10">
                            <button type="button" class="h1n1_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('h1n1', 'h1n1')"><i class="fa fa-times"></i> Apagar</button>
                        </div>

                        <div id="h1n1_edit" class="col-sm-2 col-xs-2 p-0 text-right">
                        </div>
                        <div id="h1n1_cancel" class="col-sm-2 col-xs-2 p-0 text-right d-none">
                        </div>
                    </div>
                    <div id="h1n1" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <b class="col-sm-12 col-xs-12 row m-0 p-l-10 p-r-10 text-left">Dose Anual</b>
                    <div id="h1n1_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
                    </div>
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
                        <div class="col-sm-10 col-xs-10">
                            <button type="button" class="obervacao_apagar font-11 p-0 text-danger btn-link d-none" onclick="apagaVacina('obervacao', 'obervacao')"><i class="fa fa-times"></i> Apagar</button>
                        </div>

                        <div id="obervacao_edit" class="col-sm-2 col-xs-2 p-0 text-right">
                        </div>
                        <div id="obervacao_cancel" class="col-sm-2 col-xs-2 p-0 text-right d-none">
                        </div>
                    </div>
                    <div id="obervacao" class="col-sm-12 col-xs-12 row m-0 p-0 text-left"></div>
                    <div id="obervacao_save" class="col-sm-12 col-xs-12 m-t-10 p-0 text-right d-none">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- descomentar para manutenções --}}
{{-- @include('scripts')
<script src="{{URL::asset('js/getUrlParameter.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/newUrl.js')}}" type="text/javascript"></script> --}}

<script>

    /*
     * Apaga vacinas indivitualmente
    */
    function apagaVacina(stringIds, divEdit) {
        console.log($(`#input${stringIds}`).val());
        if ($(`#input${stringIds}`).val() === '') {
            toastr.error("Nenhum a ser apagado!");
            return null;
        }

        let id = JSON.parse('{!! json_encode($id) !!}');

        arryStringIds = [stringIds];
        arryValues = [''];

        let data = {
            "id": id,
            "stringId": arryStringIds,
            "value": arryValues,
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
                toastr.success('Apagado com sucesso!')
                $(`#input${stringIds}`).val("");
                $(`#b_${stringIds}`).text("Valor apagado! Atualize a página.");
                $(`#b_${stringIds}`).removeClass('text-danger');
                $(`#b_${stringIds}`).removeClass('text-davita');
                $(`#${stringIds}`).addClass('text-warning');
                $(`#${stringIds}`).addClass('font-12');
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
    }

    /*
     * Salva o grupo de vacinas
    */
    function saveVacina(stringIds, divEdit) {

        let id = JSON.parse('{!! json_encode($id) !!}');
        var arrayIds = stringIds.split(',');

        var values = [];
        var names = [];
        arrayIds.forEach(element => {
            var value = $(`#input${element}`).val();
            values.push(value);
            names.push(element);

            if (
                ((element.substr(-5) != 'valor') &&
                (element != 'covid_laboratorio')) &&
                (element != 'obervacao')
            ) {
                var momento = moment(value);
                if ((moment(value).isBefore('1900-01-01') === true) || (momento.isValid(value) === false)) return null;
            }
        });

        let data = {
            "id": id,
            "stringId": names,
            "value": values,
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

                arrayIds.forEach(element => {
                    var value = $(`#input${element}`).val();
                    var momento = moment(value);
                    if (momento.isValid(value)) {
                        $(`#b_${element}`).text(moment(value).format('DD/MM/YYYY'));
                    } else {
                        if (value) $(`#b_${element}`).text(value);
                    }
                    $(`#b_${element}`).removeClass('text-danger');
                    $(`#b_${element}`).removeClass('text-warning');
                    $(`#b_${element}`).addClass('text-davita');
                });
            },
            dataType: "text",
            error: function(error) {
                var error = JSON.parse(error.responseText).error
                toastr.error(error)
            }
        });
        editaVacina(stringIds, divEdit)
    }

    /*
     * Manimupa a exibição dos botões Editar Salvar, Cancelar e dos inputs de cada grupo de vacinas
    */
    function editaVacina(stringIds, divEdit) {
        var num = 0;
        var value = stringIds.split(',');
        value.forEach(element => {
            var children = document.getElementById(element).children;
            var classe = children[0].classList;
            var numArray = children[0].classList.length - 1;
            if (classe[numArray] === 'd-none') {
                if (element === 'h1n1') $(`#b2_${element}`).removeClass('d-none');
                $(`#div_${element}`).addClass('d-none');
                $(`.${divEdit}_apagar`).addClass('d-none');
                $(`#b_${element}`).removeClass('d-none');

                $(`#${divEdit}_edit`).removeClass('d-none');
                $(`#${divEdit}_cancel`).addClass('d-none');
                $(`#${divEdit}_save`).addClass('d-none');
            } else {
                if (element === 'h1n1') $(`#b2_${element}`).addClass('d-none');
                $(`#div_${element}`).removeClass('d-none');
                $(`.${divEdit}_apagar`).removeClass('d-none');
                $(`#b_${element}`).addClass('d-none');

                $(`#input${element}`).val();

                $(`#${divEdit}_edit`).addClass('d-none');
                $(`#${divEdit}_cancel`).removeClass('d-none');
                $(`#${divEdit}_save`).removeClass('d-none');
            }
        });
    }

    /*
     * Cria os botões Editar Salvar e Cancelar para cada grupo de vacinas
    */
    function btnsEditConfirmCancel(stringIds, divEdit) {
        var edit = `<a href="#" class="font-18" onclick="editaVacina('${stringIds}', '${divEdit}')"><i class="fa fa-edit"></i></a>`;

        var cancel = `<a href="#" class="p-0 font-18 text-muted" onclick="editaVacina('${stringIds}', '${divEdit}')"><i class="fa fa-times"></i></a>`;

        var save = `<button type="button" class="m-5 font-14 text-success btn-link" onclick="saveVacina('${stringIds}', '${divEdit}')"><i class="fa fa-check"></i> Salvar</button>
        <button type="button" class="m-5 font-14 text-muted btn-link" onclick="editaVacina('${stringIds}', '${divEdit}')"><i class="fa fa-times"></i> Cancelar</button>`;

        $(`#${divEdit}_edit`).html(edit);
        $(`#${divEdit}_cancel`).html(cancel);
        $(`#${divEdit}_save`).html(save);
    }

    /*
     * Cria os inputs para cada grupo de vacinas
    */
    function inputs(stringId, dNone) {
        var display = (dNone === true) ? 'd-none' : '';

        if ((stringId.substr(-5) === 'valor') || (stringId === 'covid_laboratorio')) {
            var placeholder = (stringId === 'covid_laboratorio') ? 'Laboratório' : 'Valor';
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <input type="text" class="form-control rounded" autocomplete="off" value="" id="input${stringId}" placeholder="${placeholder}" maxlength="191">
                    </div>
                </div>
            </div>`;
            return html;
        } else if (stringId === 'obervacao') {
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <textarea class="form-control rounded" autocomplete="off" autocomplete="off" value="" id="input${stringId}" placeholder="Observação..." maxlength="500"></textarea>
                    </div>
                </div>
            </div>`;
            return html;
        } else {
            var html = `<div id="div_${stringId}" class="text-left form-group row m-0 p-5 ${display}">
                <div class="text-left form-group row m-0 m-t-5">
                    <div>
                        <input type="date" class="form-control rounded" autocomplete="off" value="" id="input${stringId}" min="2000-01-02">
                    </div>
                </div>
            </div>`;
            return html;
        }
    }

    /*
     * Controla a exibiçao dos valores e as mensagens de doses aplicasdas, em atraso e faltando pouco tempo para a dose
    */
    function showOrInset(data, stringId, stringIdRequisito, diasValidade) {
        var primeiraDose = moment(data[stringIdRequisito]);
        var hoje = moment();
        var mesATras = hoje.diff(primeiraDose, 'months');

        var message = '';
        function stringB(text, classe, stringId) {
            return `<b id="b_${stringId}" class="col-xs-12 m-t-10 p-l-10 font-bold ${classe}">${text}</b>`;
        }

        if ((stringIdRequisito != false)&&(mesATras >= diasValidade)&&(data[stringId] === null)) {

            var msg = (mesATras >= 2) ? `${mesATras} meses` : `${mesATras} mês`;
            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' '+`<b id="b2_${stringId}" class="col-xs-12 m-t-0 p-l-10 font-bold text-danger">DOSE em Atraso – ${msg}</b>`;
            } else {
                message = stringB(`DOSE em Atraso – ${msg}`, 'text-danger', stringId);
            }

        } else if ((stringIdRequisito != false)&&(mesATras === (diasValidade - 1))&&(data[stringId] === null)) {

            if (stringId === 'h1n1') {
                message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId)+' '+`<b id="b2_${stringId}" class="col-xs-12 m-t-0 p-l-10 font-bold text-warning">Falta menos de 1 mês</b>`;
            } else {
                message = stringB(`Falta menos de 1 mês`, 'text-warning', stringId);
            }

        } else if (data[stringIdRequisito] === null) {
            message = stringB(`1ª DOSE Não Aplicada`, 'text-davita', stringId);
        } else if (data[stringId] === null) {
            message = stringB(`Aguardando`, 'text-davita', stringId);
        } else if ((stringId.substr(-5) === 'valor') || (stringId === 'obervacao') || (stringId === 'covid_laboratorio')) {
            message = stringB(`${data[stringId]}`, 'text-davita', stringId);
        } else {
            message = stringB(`${moment(data[stringId]).format('DD/MM/YYYY')}`, 'text-davita', stringId);
        }

        return message+''+inputs(stringId, true);
    }

    /*
     * O início de tudo
     * Busca os valores
     * Chama as funções "showOrInset()" e "btnsEditConfirmCancel()" acima
     * Define os valores dos inputs
    */
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
                btnsEditConfirmCancel(['covid_laboratorio','covid_primeira_dose','covid_segunda_dose'], 'covid');
                $(`#inputcovid_laboratorio`).val(data[0]['covid_laboratorio']);
                $(`#inputcovid_primeira_dose`).val(data[0]['covid_primeira_dose']);
                $(`#inputcovid_segunda_dose`).val(data[0]['covid_segunda_dose']);

                $("#da_primeira_dose").html(showOrInset(data[0], "da_primeira_dose", false, false));
                $("#da_segunda_dose").html(showOrInset(data[0], "da_segunda_dose", "da_primeira_dose", 2));
                $("#da_terceira_dose").html(showOrInset(data[0], "da_terceira_dose", "da_primeira_dose", 4));
                btnsEditConfirmCancel(['da_primeira_dose','da_segunda_dose','da_terceira_dose'], 'da');
                $(`#inputda_primeira_dose`).val(data[0]['da_primeira_dose']);
                $(`#inputda_segunda_dose`).val(data[0]['da_segunda_dose']);
                $(`#inputda_terceira_dose`).val(data[0]['da_terceira_dose']);

                $("#scr").html(showOrInset(data[0], "scr", false, false));
                btnsEditConfirmCancel(['scr'], 'scr');
                $(`#inputscr`).val(data[0]['scr']);

                $("#hepatite_b_primeira_dise").html(showOrInset(data[0], "hepatite_b_primeira_dise", false, false));
                $("#hepatite_b_segunda_dose").html(showOrInset(data[0], "hepatite_b_segunda_dose", "hepatite_b_primeira_dise", 1));
                $("#hepatite_b_terceira_dose").html(showOrInset(data[0], "hepatite_b_terceira_dose", "hepatite_b_primeira_dise", 6));
                btnsEditConfirmCancel(['hepatite_b_primeira_dise','hepatite_b_segunda_dose','hepatite_b_terceira_dose'], 'hepatite_b');
                $(`#inputhepatite_b_primeira_dise`).val(data[0]['hepatite_b_primeira_dise']);
                $(`#inputhepatite_b_segunda_dose`).val(data[0]['hepatite_b_segunda_dose']);
                $(`#inputhepatite_b_terceira_dose`).val(data[0]['hepatite_b_terceira_dose']);

                $("#scr_reforco").html(showOrInset(data[0], "scr_reforco", false, false));
                $("#dt_reforco").html(showOrInset(data[0], "dt_reforco", false, false));
                $("#h1n1").html(showOrInset(data[0], "h1n1", "h1n1", 120));
                btnsEditConfirmCancel(['scr_reforco'], 'scr_reforco');
                btnsEditConfirmCancel(['dt_reforco'], 'dt_reforco');
                btnsEditConfirmCancel(['h1n1'], 'h1n1');
                $(`#inputscr_reforco`).val(data[0]['scr_reforco']);
                $(`#inputdt_reforco`).val(data[0]['dt_reforco']);
                $(`#inputh1n1`).val(data[0]['h1n1']);

                $("#antihbs_data").html(showOrInset(data[0], "antihbs_data", false, false));
                $("#antihbs_valor").html(showOrInset(data[0], "antihbs_valor", false, false));
                btnsEditConfirmCancel(['antihbs_data','antihbs_valor'], 'antihbs');
                $(`#inputantihbs_data`).val(data[0]['antihbs_data']);
                $(`#inputantihbs_valor`).val(data[0]['antihbs_valor']);

                $("#igg_data").html(showOrInset(data[0], "igg_data", false, false));
                $("#igg_valor").html(showOrInset(data[0], "igg_valor", false, false));
                btnsEditConfirmCancel(['igg_data','igg_valor'], 'igg');
                $(`#inputigg_data`).val(data[0]['igg_data']);
                $(`#inputigg_valor`).val(data[0]['igg_valor']);

                $("#obervacao").html(showOrInset(data[0], "obervacao", false, false));
                btnsEditConfirmCancel(['obervacao'], 'obervacao');
                $(`#inputobervacao`).val(data[0]['obervacao']);
            }
        });
    });
</script>
