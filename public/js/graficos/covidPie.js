
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
    console.log(totalCasosCovid);
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(totalCasosCovidPie);

    function totalCasosCovidPie() {
        var data = google.visualization.arrayToDataTable(totalCasosCovid);
        var options = {
            title: `Total casos COVID por unidade`,
            axisTitlesPosition: 'in',
            pieHole: 0.4,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:10,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('totalCasosCovidPie'));
        chart.draw(data, options);
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
    console.log(qtdDiasPerdidosMes);
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(qtdDiasPerdidosMesPie);

    function qtdDiasPerdidosMesPie() {
        var data = google.visualization.arrayToDataTable(qtdDiasPerdidosMes);
        var options = {
            top: 30,
            title: `Quantidade de dias perdidos por unidade`,
            pieHole: 0.4,
            legend: 'bottom',
            backgroundColor: 'transparent',
            chartArea: {left:10,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('qtdDiasPerdidosMesPie'));
        chart.draw(data, options);
    }
/** /Quantidade de dias perdidos por unidade **/
