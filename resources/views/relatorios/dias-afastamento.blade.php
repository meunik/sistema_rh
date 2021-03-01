@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <div class="container">
            <div class="row">
                @include('relatorios.filtro')
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                <thead>
                    <tr class="info">
                        <th class="text-center" colspan="4">ANÁLISE NO PERÍODO</th>
                    </tr>
                        <tr class="active">
                            <th class="text-center"></th>
                            <th class="text-center">Colegas que retornaram</th>
                            <th class="text-center">Colegas que se afastaram</th>
                            <th class="text-center">Colegas que continuam afastados</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-nowrap">
                        <tr>
                            <td>AT</td>
                            <td>@isset($resultados['RET']['AT']) {{$resultados['RET']['AT']}} @endisset</td>
                            <td>@isset($resultados['AF']['AT']) {{$resultados['AF']['AT']}} @endisset</td>
                            <td>@isset($resultados['AF-C']['AT']) {{$resultados['AF-C']['AT']}} @endisset</td>
                        </tr>
                        <tr>
                            <td>CO-S</td>
                            <td>@isset($resultados['RET']['CO-S']) {{$resultados['RET']['CO-S']}} @endisset</td>
                            <td>@isset($resultados['AF']['CO-S']) {{$resultados['AF']['CO-S']}} @endisset</td>
                            <td>@isset($resultados['AF-C']['CO-S']) {{$resultados['AF-C']['CO-S']}} @endisset</td>
                        </tr>
                        <tr>
                            <td>CO+</td>
                            <td>@isset($resultados['RET']['CO+']) {{$resultados['RET']['CO+']}} @endisset</td>
                            <td>@isset($resultados['AF']['CO+']) {{$resultados['AF']['CO+']}} @endisset</td>
                            <td>@isset($resultados['AF-C']['CO+']) {{$resultados['AF-C']['CO+']}} @endisset</td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                            <td>@isset($resultados['RET']['TOTAL']) {{$resultados['RET']['TOTAL']}} @endisset</td>
                            <td>@isset($resultados['AF']['TOTAL']) {{$resultados['AF']['TOTAL']}} @endisset</td>
                            <td>@isset($resultados['AF-C']['TOTAL']) {{$resultados['AF-C']['TOTAL']}} @endisset</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $("#filtrar").click(function(event) {
        event.preventDefault();

        let inicial = "";
        let final = "";

        inicial = $("#data_inicial").val();
        final = $("#data_final").val();

        newUrl(inicial,final);
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

    var newUrl = function newUrl(inicial,final) {
        var params = {
            'inicial':inicial,
            'final':final
        };
        var url = '/relatorios/dias-afastamento?' + jQuery.param(params);
        window.location.href = url;
    };


    $(document).ready( function () {
        var inicial = getUrlParameter('inicial');
        var final = getUrlParameter('final');

        $('.panel').hide();
        $('#tipo_filtro').hide();

        if((inicial != undefined && final != undefined) && (inicial != '' && final != '')) {
            $('#data_inicial').val(inicial);
            $('#data_final').val(final);
        } else {
            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day);

            newUrl(today,today);
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

@endsection
