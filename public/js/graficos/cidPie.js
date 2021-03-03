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
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(totalAtestadosPie);
    }

    function totalAtestadosPie() {
        var data = google.visualization.arrayToDataTable(totalAtestados);
        var options = {
            title: `Quatidade de atestados por grupo CID`,
            axisTitlesPosition: 'in',
            pieHole: 0.4,
            legend: 'right',
            backgroundColor: 'transparent',
            chartArea: {left:0,right:10,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('totalAtestadosPie'));
        chart.draw(data, options);
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
        google.charts.load('current', {packages:['corechart']});
        google.charts.setOnLoadCallback(qtdDiasPerdidosMesPie);
    }

    function qtdDiasPerdidosMesPie() {
        var data = google.visualization.arrayToDataTable(qtdDiasPerdidosMes);
        var options = {
            top: 30,
            title: `Quantidade de dias perdidos por grupo CID`,
            pieHole: 0.4,
            legend: 'right',
            backgroundColor: 'transparent',
            chartArea: {left:10,right:0,top:50,bottom:40}
        };
        var chart = new google.visualization.PieChart(document.getElementById('qtdDiasPerdidosMesPie'));
        chart.draw(data, options);
    }
/** /Quantidade de dias perdidos por grupo CID **/
