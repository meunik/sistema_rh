
/** Total casos COVID por unidade **/
    function totalCasosCovid() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/covid/totalCasosCovid`,
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

    var totalCasosCovid = totalCasosCovid().data;
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(totalCasosCovidCharts);

    function totalCasosCovidCharts() {
        var data = google.visualization.arrayToDataTable(totalCasosCovid);
        var options = {
            title: 'Total casos COVID por unidade',
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
        var chart = new google.charts.Bar(document.getElementById('totalCasosCovidCharts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
/** /Total casos COVID por unidade **/

/** Quantidade de dias perdidos por unidade **/
    function qtdDiasPerdidosMes() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/covid/qtdDiasPerdidosMes`,
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

    var qtdDiasPerdidosMes = qtdDiasPerdidosMes().data;
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(qtdDiasPerdidosMesCharts);

    function qtdDiasPerdidosMesCharts() {
        var data = google.visualization.arrayToDataTable(qtdDiasPerdidosMes);
        var options = {
            title: 'Quantidade de dias perdidos por unidade',
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
/** /Quantidade de dias perdidos por unidade **/
