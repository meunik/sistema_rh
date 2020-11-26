@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="row">
            @include('relatorios.filtro')
        </div>
        <h3 class="font-bold">TABELA DE INDICADORES DE ABSENTEÍSMO POR DIA E POR UNIDADE</h3>
        <div class="table-responsive">
        <table class="table table-bordered table-condensed">
                <thead>
                    <tr class="active">
                        <th class="text-center">Filial</th>
                        <th class="text-center">Nro Colegas</th>
                        <th class="text-center">Faltas</th>
                        <th class="text-center">Atestado</th>
                        <th class="text-center">Férias</th>
                        <th class="text-center">Folga</th>
                        <th class="text-center">COVID Suspeita</th>
                        <th class="text-center">COVID+</th>
                        <th class="text-center">COVID GRUPORISCO</th>
                        <th class="text-center">Total de Colegas Ausentes</th>
                        <th class="text-center">% Absenteismo</th>
                    </tr>
                </thead>
                <tbody class="text-center text-nowrap">
                    @foreach($resultados as $unidade => $resultado)
                        <tr>
                            <td>{{$unidade}}</td>
                            <td>{{$resultado['total_colegas']}}</td>
                            <td>{{$resultado['FA']}}</td>
                            <td>{{$resultado['AT']}}</td>
                            <td>{{$resultado['FE']}}</td>
                            <td>{{$resultado['FO']}}</td>
                            <td>{{$resultado['CO-S']}}</td>
                            <td>{{$resultado['CO+']}}</td>
                            <td>{{$resultado['GR']}}</td>
                            <td>{{$resultado['total_ausentes']}}</td>
                            <td>
                                @if($resultado['total_colegas'] > 0)
                                    {{number_format(($resultado['total_ausentes']/$resultado['total_colegas'])*100, 2, ',', ' ')}}%
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            <div class="white-box">
                <h3 class="box-title">GRÁFICO DE INDICADORES DE ABSENTEÍSMO POR DIA E POR UNIDADE <small>Passe o mouse para ver os detalhes</small></h3>
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
        var url = '/relatorios/absenteismo-unidade?' + jQuery.param(params);
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
        let chart = JSON.parse('{!! json_encode($chart) !!}');
        chart = Object.entries(chart);

        let unidades = JSON.parse('{!! json_encode($unidades) !!}');
        unidades = Object.entries(unidades);
        
        let hospitais = [];
         for (let i = 0; i < unidades.length; i++) {
            hospitais[i] = unidades[i][1]['nome'];
        }

        let data = [];
        for (let i = 0; i < chart.length; i++) {
            data[i] = chart[i][1];
            data[i]['data'] = chart[i][0];
        }

        Morris.Area({
            element: 'produtividade',
            data: data,
            xkey: 'data',
            xLabelFormat: function (x) { return x.label.toString(); },
            ykeys: hospitais,
            labels: hospitais,
            yLabelFormat: function (y) { return y.toFixed(2) + '%'; },
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
