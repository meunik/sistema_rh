
/** Quantidade de atestados por unidade **/
    function qtdAtestadosPorHosp() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/atestados/qtdAtestadosPorHosp`,
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

    var qtdAtestadosPorHosp = qtdAtestadosPorHosp().data;
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(qtdAtestadosPorHospCharts);

    function qtdAtestadosPorHospCharts() {
        var data = google.visualization.arrayToDataTable(qtdAtestadosPorHosp);
        var options = {
            title: 'Quantidade de atestados por unidade',
            legend: {
                position: 'none',
                textStyle: {
                    fontSize: 10,
                    bold: true,
                }
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
        var chart = new google.charts.Bar(document.getElementById('qtdAtestadosPorHospCharts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
/** /Quantidade de atestados por unidade **/

/** Quantidade de dias perdidos por unidade **/
    function qtdDiasPerdidosPorHosp() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/atestados/qtdDiasPerdidosPorHosp`,
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

    var qtdDiasPerdidosPorHosp = qtdDiasPerdidosPorHosp().data;
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(qtdDiasPerdidosPorHospCharts);

    function qtdDiasPerdidosPorHospCharts() {
        var data = google.visualization.arrayToDataTable([
            ['', 'Sales', 'Expenses', 'Profit', 'Sales', 'Expenses', 'Profit', 'Sales', 'Expenses', 'Profit', 'Sales', 'Expenses', 'Profit'],
            ['Quantidade de atestados por unidade', 1030, 540, 350, 660, 1120, 300, 1170, 460, 250, 1000, 400, 200]
        ]);
        var options = {
            title: 'Quantidade de dias perdidos por unidade',
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {
                left:40,
                right:0,
                top:50,
                backgroundColor: 'transparent',
            },
        };
        var chart = new google.charts.Bar(document.getElementById('qtdDiasPerdidosPorHospCharts'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
/** /Quantidade de dias perdidos por unidade **/
