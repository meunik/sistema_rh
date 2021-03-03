
function tabela(inicial, final) {
    $('#atestadosTabela').removeClass('d-none');

    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/atestados/getdata?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        ordering:  false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'hospital_nome', className: 'text-center' },
            { data: 'colegasAtivos', className: 'text-center background-tabelas-graficos' },
            { data: 'totalDeAtestados', className: 'text-center' },
            { data: 'atestadosPorAcidenteOuDoenca', className: 'text-center' },
            { data: 'atestadosPorOutrosMotivos', className: 'text-center' },
            { data: 'qtdAtestadosNaoCotatados', className: 'text-center' },
            { data: 'qtdAtestadosComContatoPeriodo', className: 'text-center' },
            { data: 'atestados1Ou2Dias', className: 'text-center' },
            { data: 'atestados3A15Dias', className: 'text-center' },
            { data: 'atestadosAcimaDe15Dias', className: 'text-center' },
            { data: 'qtdDiasPerdidosMes', className: 'text-center' },
            { data: 'porcentagemDeAtestadosPorColegas', className: 'text-center background-tabelas-graficos' },
        ],
    });

    const topCincoQtdAtestados = $('#topCincoQtdAtestados').DataTable({
        ajax: { "url": `/graficos/atestados/topCincoQtdAtestados?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        searching: false,
        ordering:  false,
        columns: [
            { data: 'hospital_nome', className: 'text-center' },
            { data: 'totalDeAtestados', className: 'text-center' },
        ],
    });

    const topCincoQtdDiasPerdidos = $('#topCincoQtdDiasPerdidos').DataTable({
        ajax: { "url": `/graficos/atestados/topCincoQtdDiasPerdidos?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        searching: false,
        ordering:  false,
        columns: [
            { data: 'hospital_nome', className: 'text-center' },
            { data: 'qtdDiasPerdidosMes', className: 'text-center' },
        ],
    });
}

$("#filtrar").click(function(event) {
    let inicial = "";
    let final = "";

    inicial = $("#data_inicial").val();
    final = $("#data_final").val();

    var params = {
        'inicial': inicial,
        'final': final,
    };

    newUrl(params);
});

$(document).ready( function () {
    var inicial = getUrlParameter('inicial');
    var final = getUrlParameter('final');

    if(inicial && final) {
        tabela(inicial, final);
        $("#data_inicial").val(inicial);
        $("#data_final").val(final);
    }
});
