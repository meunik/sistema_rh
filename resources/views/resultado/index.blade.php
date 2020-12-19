@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="row">
            @include('resultado.filtro')
        </div>
        <div class="table-responsive">
            <table id="resultado" class="table table-bordered table-condensed">
                <thead>
                    <tr class="success">
                        <!--<th class="text-center text-nowrap">Tipo de Clínica</th>-->
                        <!--<th class="text-center text-nowrap">Responsável</th>-->
                        <th class="text-center text-nowrap">Coligada</th>
                        <!--<th class="text-center text-nowrap">Cod. Filial</th>-->
                        <th class="text-center text-nowrap">Filial</th>
                        <th class="text-center text-nowrap">Local</th>
                        <!--<th class="text-center text-nowrap">Dt Inicio Clínica</th>-->
                        <!--<th class="text-center text-nowrap">Chapa</th>-->
                        <th class="text-center text-nowrap">Nome</th>
                        <!--<th class="text-center text-nowrap">Dt Nascimento</th>-->
                        <th class="text-center text-nowrap">Idade</th>
                        <!--<th class="text-center text-nowrap">C. Custo</th>-->
                        <!--<th class="text-center text-nowrap">Situação</th>-->
                        <th class="text-center text-nowrap">Funcão</th>
                        <!--<th class="text-center text-nowrap">Dt Admissão</th>-->
                        <!--<th class="text-center text-nowrap">Dt Demissão</th>-->
                        <th class="text-center text-nowrap">Seção</th>
                        <!--<th class="text-center text-nowrap">Cd. Horário</th>-->
                        <!--<th class="text-center text-nowrap">Horário</th>-->
                        <!--<th class="text-center text-nowrap">Cod. Demissão</th>-->
                        <!--<th class="text-center text-nowrap">Tipo Demissão</th>-->
                        <!--<th class="text-center text-nowrap">Jornada</th>-->
                        @foreach($datas as $data)
                            <th class="text-center text-nowrap">{{$data}}</th>
                        @endforeach
                        <th class="text-center text-nowrap">CID</th>
                        <th class="text-center text-nowrap">Data do Afastamento</th>
                        <th class="text-center text-nowrap">Data final do atestado</th>
                        <!--<th class="text-center text-nowrap">Classificação</th>-->
                        <th class="text-center text-nowrap">Dias de Atestado</th>
                        <th class="text-center text-nowrap">Data de Início dos Sintomas</th>
                        <th class="text-center text-nowrap">Data da Realização do Teste</th>
                        <th class="text-center text-nowrap">Tipo do Teste</th>
                        <th class="text-center text-nowrap">Telefone do Colega</th>
                        <th class="text-center text-nowrap">Motivo</th>
                        <th class="text-center text-nowrap">Observação</th>
                        <th class="text-center text-nowrap">Obs. Assistente Social</th>
                        <th class="text-center text-nowrap">Grupo de Risco</th>
                        <th class="text-center text-nowrap">Atualizado por</th>
                        <th class="text-center text-nowrap">Atualizado em</th>
                    </tr>
                </thead>
                <tbody class="text-center text-nowrap">
                    @foreach ($resultados as $nome => $resultado)
                    <tr class="{{$resultado['retornou']}}">
                        <td>{{$resultado['coligada']}}</td>
                        <td>{{$resultado['filial_nome']}}</td>
                        <td>{{$resultado['local']}}</td>
                        <td>{{$nome}}</td>
                        <td>{{$resultado['idade']}}</td>
                        <td>{{$resultado['funcao']}}</td>
                        </td>
                        <td>{{$resultado['secao']}}</td>
                        @foreach ($resultado['datas'] as $data)
                            <td>
                                @isset($data['cod'])
                                    {{$data['cod']}}
                                @endisset
                            </td>
                        @endforeach
                        <td>{{$resultado['cid']}}</td>
                        <td>
                            @if($resultado['data_inicio_afastamento'])
                                {{date('d/m/Y', strtotime($resultado['data_inicio_afastamento']))}}
                            @endif
                        </td>
                        <td>
                            @if($resultado['data_final_atestado'])
                                {{date('d/m/Y', strtotime($resultado['data_final_atestado']))}}
                            @endif
                        </td>
                        <td>{{$resultado['dias_de_atestado']}}</td>
                        <td>
                            @if($resultado['data_dos_sintomas'])
                                {{date('d/m/Y', strtotime($resultado['data_dos_sintomas']))}}
                            @endif
                        </td>
                        <td>
                            @if($resultado['data_do_teste'])
                                {{date('d/m/Y', strtotime($resultado['data_do_teste']))}}
                            @endif
                        </td>
                        <td>{{$resultado['tipo_do_teste']}}</td>
                        <td>{{$resultado['telefone']}}</td>
                        <td>{{$resultado['motivo']}}</td>
                        <td>@foreach($resultado['observacao'] as $observacao) {{  $observacao }} <br>@endforeach</td>
                        <td>{{$resultado['assistente_social']}}</td>
                        <td>{{$resultado['grupo_de_risco']}}</td>
                        <td>{{$resultado['atualizado_por']}}</td>
                        <td>
                            @if($resultado['atualizado_em'])
                                {{date('d/m/Y H:i', strtotime($resultado['atualizado_em']))}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#hospitais_todos").change(function(event) {
        if(this.checked) {
            $('#hospitais').find('input[type=checkbox]').prop('checked', true);
        } else {
            $('#hospitais').find('input[type=checkbox]').prop('checked', false);
        }
    });
    $("#filtrar").click(function(event) {
        event.preventDefault();

        let hospitais = "";
        $('#hospitais').find('input[type=checkbox]:checked').each(function() {
            if(hospitais == "") {
                hospitais = hospitais + this.value;
            } else {
                hospitais = hospitais + "," +this.value;
            }
        });

        let tipo = "";
        let cod = "";
        let inicial = "";
        let final = "";
        tipo = $("#tipo").val();
        if(tipo == null) {
            tipo = "";
        }
        cod = $("#cod").val();
        if(cod == null) {
            cod = "";
        }
        inicial = $("#data_inicial").val();
        final = $("#data_final").val();

        newUrl(hospitais,tipo,cod,inicial,final);
    });

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

    var newUrl = function newUrl(hospitais,tipo,cod,inicial,final) {
        var params = {
            'hospitais': hospitais,
            'tipo': tipo,
            'cod': cod,
            'inicial':inicial,
            'final':final
        };
        var url = '/resultado?' + jQuery.param(params);
        window.location.href = url;
    };


    $(document).ready( function () {
        var hospitais = getUrlParameter('hospitais');

        if(hospitais != undefined) {
            var hospitais =hospitais.split(",");

            $.each( hospitais, function( i, val ) {
                $('#hospitais'+val).attr("checked", true);
            });

        }

        var tipo = getUrlParameter('tipo');

        if(tipo != undefined && tipo != '') {
            $('#tipo option[value='+tipo+']').attr('selected','selected');
        } else {
            $('#tipo option[value=""]').attr('selected','selected');
        }

        var cod = getUrlParameter('cod');

        if(cod != undefined && cod != '') {
            $("#cod option[value='"+cod+"']").attr('selected','selected');
        } else {
            $('#cod option[value=""]').attr('selected','selected');
        }

        var inicial = getUrlParameter('inicial');
        var final = getUrlParameter('final');

        if((inicial != undefined && final != undefined) && (inicial != '' && final != '')) {
            $('#data_inicial').val(inicial);
            $('#data_final').val(final);
        } else {
            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day);

            newUrl('','','',today,today);
        }
});

</script>

<script>
    $(document).ready( function () {
        let table = $('#resultado').DataTable({
            ordering:  false,
            dom: 'Brtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                }
            ],

            "language": {
                "url": "/Portuguese-Brasil.json"
            }
        });
    });
</script>

@endsection
