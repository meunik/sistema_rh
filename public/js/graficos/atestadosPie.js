
/** Distribuição atestados **/
    function totalQtdDias() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/atestados/totalQtdDias`,
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

    var dados = totalQtdDias().data;
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(totalQtdDiasPie);

    function totalQtdDiasPie() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Dias Atestados'],
            ['Atestados 1 ou 2 dias', dados[0][0]],
            ['Atestados de 3 a 15 dias', dados[1][0]],
        ]);
        var options = {
            title: `Distribuição atestados
                    (quantidade de dias)`,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('totalQtdDiasPie'));
        chart.draw(data, options);
    }
/** /Distribuição atestados **/

/** Top 5 unidades com maior quantidade de atestados **/
    function topCincoQtdAtestados() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/atestados/topCincoQtdAtestados`,
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

    var topCincoQtdAtestados = topCincoQtdAtestados().data;
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(topCincoQtdAtestadosPie);

    function topCincoQtdAtestadosPie() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Quantidade de Atestados'],
            [topCincoQtdAtestados[0]['hospital_nome'], topCincoQtdAtestados[0]['totalDeAtestados']],
            [topCincoQtdAtestados[1]['hospital_nome'], topCincoQtdAtestados[1]['totalDeAtestados']],
            [topCincoQtdAtestados[2]['hospital_nome'], topCincoQtdAtestados[2]['totalDeAtestados']],
            [topCincoQtdAtestados[3]['hospital_nome'], topCincoQtdAtestados[3]['totalDeAtestados']],
            [topCincoQtdAtestados[4]['hospital_nome'], topCincoQtdAtestados[4]['totalDeAtestados']],
        ]);
        var options = {
            title: `Top 5 unidades com maior quantidade de atestados`,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('topCincoQtdAtestadosPie'));
        chart.draw(data, options);
    }
/** /Top 5 unidades com maior quantidade de atestados **/

/** Top 5 unidades com maior quantidade de dias perdidos **/
    function topCincoQtdDiasPerdidos() {
        var resultado;
        $.ajax({
            type: "GET",
            url: `/graficos/atestados/topCincoQtdDiasPerdidos`,
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

    var topCincoQtdDiasPerdidos = topCincoQtdDiasPerdidos().data;
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(topCincoQtdDiasPerdidosPie);

    function topCincoQtdDiasPerdidosPie() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Quantidade de Atestados'],
            [topCincoQtdDiasPerdidos[0]['hospital_nome'], topCincoQtdDiasPerdidos[0]['qtdDiasPerdidosMes']],
            [topCincoQtdDiasPerdidos[1]['hospital_nome'], topCincoQtdDiasPerdidos[1]['qtdDiasPerdidosMes']],
            [topCincoQtdDiasPerdidos[2]['hospital_nome'], topCincoQtdDiasPerdidos[2]['qtdDiasPerdidosMes']],
            [topCincoQtdDiasPerdidos[3]['hospital_nome'], topCincoQtdDiasPerdidos[3]['qtdDiasPerdidosMes']],
            [topCincoQtdDiasPerdidos[4]['hospital_nome'], topCincoQtdDiasPerdidos[4]['qtdDiasPerdidosMes']],
        ]);
        var options = {
            title: `Top 5 unidades com maior quantidade de dias perdidos`,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('topCincoQtdDiasPerdidosPie'));
        chart.draw(data, options);
    }
/** /Top 5 unidades com maior quantidade de dias perdidos **/

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
    console.log(qtdAtestadosPorHosp);
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(qtdAtestadosPorHospPie);

    function qtdAtestadosPorHospPie() {
        var data = google.visualization.arrayToDataTable(qtdAtestadosPorHosp);
        var options = {
            title: `Quantidade de atestados por unidade`,
            axisTitlesPosition: 'in',
            pieHole: 0.4,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:10,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('qtdAtestadosPorHospPie'));
        chart.draw(data, options);
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
    console.log(qtdDiasPerdidosPorHosp);
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(qtdDiasPerdidosPorHospPie);

    function qtdDiasPerdidosPorHospPie() {
        var data = google.visualization.arrayToDataTable(qtdDiasPerdidosPorHosp);
        var options = {
            top: 30,
            title: `Quantidade de dias perdidos por unidade`,
            pieHole: 0.4,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:10,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('qtdDiasPerdidosPorHospPie'));
        chart.draw(data, options);
    }
/** /Quantidade de dias perdidos por unidade **/
