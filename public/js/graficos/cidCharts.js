var inicial = getUrlParameter('inicial');
var final = getUrlParameter('final');

/** Quatidade de atestados por grupo CID **/
    function totalAtestados(inicial, final) {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/cid/totalAtestados?inicial=${inicial}&final=${final}`,
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
        return resultado;
    };

    if(inicial && final) {
        var totalAtestados = totalAtestados(inicial, final).data;
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(totalAtestadosCharts);
    }

    function totalAtestadosCharts() {
        var data = google.visualization.arrayToDataTable(totalAtestados);
        var options = {
            title: 'Quatidade de atestados por grupo CID',
            titleTextStyle: {
                color: '#333b3f',
                fontSize: 16,
                bold: false
            },
            legend: {
                position: 'none',
                textStyle: {
                    fontSize: 10,
                    bold: true,
                }
            },
            hAxis: {
                textStyle: { color: 'transparent' },
            },
            backgroundColor: 'transparent',
            chartArea: {
                left:0,
                right:0,
                top:50,
                backgroundColor: 'transparent',
            },
            legendpagination: true,
        };
        var chart = new google.charts.Bar(document.getElementById('totalAtestadosCharts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
/** /Quatidade de atestados por grupo CID **/

/** Quantidade de dias perdidos por grupo CID **/
    function qtdDiasPerdidosMes(inicial, final) {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/cid/qtdDiasPerdidosMes?inicial=${inicial}&final=${final}`,
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
        return resultado;
    };

    if(inicial && final) {
        var qtdDiasPerdidosMes = qtdDiasPerdidosMes(inicial, final).data;
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(qtdDiasPerdidosMesCharts);
    }

    function qtdDiasPerdidosMesCharts() {
        var data = google.visualization.arrayToDataTable(qtdDiasPerdidosMes);
        var options = {
            title: 'Quantidade de dias perdidos por grupo CID',
            titleTextStyle: {
                color: '#333b3f',
                fontSize: 16,
                bold: false
            },
            legend: {
                position: 'none',
                textStyle: {
                    fontSize: 10,
                    bold: true,
                }
            },
            hAxis: {
                textStyle: { color: 'transparent' },
            },
            backgroundColor: 'transparent',
            chartArea: {
                left:0,
                right:0,
                top:50,
                backgroundColor: 'transparent',
            },
            legendpagination: true,
        };
        var chart = new google.charts.Bar(document.getElementById('qtdDiasPerdidosMesCharts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
/** /Quantidade de dias perdidos por grupo CID **/
