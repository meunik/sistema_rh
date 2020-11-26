@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="row">
            @include('relatorios.filtro')
        </div>
        <h3 class="font-bold">TABELA DE ABSENTEÍSMO TOTAL</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr class="success">
                        <th class="text-center">Base Clínica</th>
                        @foreach ($resultados as $data => $resultado)
                            <th class="text-center">{{$data}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-center text-nowrap">
                    <tr>
                        <td>Nro de Colegas</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['total']))
                                    {{$resultado['total']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>FALTAS</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['FA']))
                                    {{$resultado['FA']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>ATESTADO</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['AT']))
                                    {{$resultado['AT']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>FÉRIAS</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['FE']))
                                    {{$resultado['FE']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>FOLGA</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['FO']))
                                    {{$resultado['FO']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>COVID SUSPEITA</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['covid_suspeita']))
                                    {{$resultado['covid_suspeita']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>COVID+</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['covid_confirmado']))
                                    {{$resultado['covid_confirmado']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>COVID GRUPODERISCO</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['GR']))
                                    {{$resultado['GR']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="info">
                        <td>Total de Colegas Ausentes</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['total_ausentes']))
                                    {{$resultado['total_ausentes']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="info">
                        <td>% Absenteismo</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['total_ausentes']) && isset($resultado['total']))
                                    @if($resultado['total'] > 0)
                                        {{number_format(($resultado['total_ausentes']/$resultado['total'])*100, 2, ',', ' ')}}%
                                    @else
                                        0%
                                    @endif
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="success">
                        <td>Nro de Colegas Efeito Covid</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['total_covid']))
                                    {{$resultado['total_covid']}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr class="success">
                        <td>%</td>
                        @foreach ($resultados as $resultado)
                            <td>
                                @if(isset($resultado['total_covid']) && isset($resultado['total']))
                                    @if($resultado['total'] > 0)
                                        {{number_format(($resultado['total_covid']/$resultado['total'])*100, 2, ',', ' ')}}%
                                    @else
                                        0%
                                    @endif
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            <div class="white-box">
                <h3 class="box-title">GRÁFICO DE ABSENTEISMO TOTAL (%) <small>Passe o mouse para ver os detalhes</small></h3>
                <div id="produtividade"></div>
            </div>
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
        let inicial = "";
        let final = "";
        tipo = $("#tipo").val();
        if(tipo == null) {
            tipo = "";
        }
        inicial = $("#data_inicial").val();
        final = $("#data_final").val();

        newUrl(hospitais,tipo,inicial,final);
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

    var newUrl = function newUrl(hospitais,tipo,inicial,final) {
        var params = {
            'hospitais': hospitais,
            'tipo': tipo,
            'inicial':inicial,
            'final':final
        };
        var url = '/relatorios/absenteismo-total?' + jQuery.param(params);
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
        var inicial = getUrlParameter('inicial');
        var final = getUrlParameter('final');

        if((inicial != undefined && final != undefined) && (inicial != '' && final != '')) {
            $('#tipo option[value='+tipo+']').attr('selected','selected');
            $('#data_inicial').val(inicial);
            $('#data_final').val(final);
        } else {
            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day);

            newUrl('','TD',today,today);
        }
});

</script>

<script>
    $(document).ready( function () {
        $('table').DataTable({
            paging: false,
            searching: false,
            ordering:  false,
            info: false,
            dom: 'B',
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

<!--Morris JavaScript -->
<script src="{{URL::asset('plugins/components/raphael/raphael-min.js')}}"></script>
<script src="{{URL::asset('plugins/components/morrisjs/morris.js')}}"></script>
<script>

        let resultados = JSON.parse('{!! json_encode($resultados) !!}');
        resultados = Object.entries(resultados);

        let data = [];
        for (let i = 0; i < resultados.length; i++) {
            data[i] = [];
            data[i]['DATA'] = resultados[i][0];

            if(resultados[i][1]['total'] > 0) {
                data[i]['FA'] = ((resultados[i][1]['FA']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['AT'] = ((resultados[i][1]['AT']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['FE'] = ((resultados[i][1]['FE']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['FO'] = ((resultados[i][1]['FO']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['CO-S'] = ((resultados[i][1]['covid_suspeita']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['CO+'] = ((resultados[i][1]['covid_confirmado']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['GR'] = ((resultados[i][1]['GR']/resultados[i][1]['total'])*100).toFixed(2);
                data[i]['TOTAL'] = ((resultados[i][1]['total_ausentes']/resultados[i][1]['total'])*100).toFixed(2);
            } else {

            }
        }

        Morris.Area({
            element: 'produtividade',
            data: data,
            xkey: 'DATA',
            xLabelFormat: function (x) { return x.label.toString(); },
            ykeys: ['FA', 'AT','FE','FO','CO-S','CO+','GR','TOTAL'],
            labels: ['FALTAS', 'ATESTADO', 'FÉRIAS', 'FOLGA', 'COVID SUSPEITA','COVID+','COVID GRUPODERISCO','TOTAL',],
            yLabelFormat: function (y) { return y.toString() + '%'; },
            pointSize: 3,
            fillOpacity: 0,
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 2,
            parseTime: false,
            hideHover: false,
        });
</script>

@endsection
