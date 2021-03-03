
function tabela(inicial, final) {
    $('#covidTabela').removeClass('d-none');

    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/covid/getdata?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        ordering:  false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'hospital_nome', className: 'text-left' },
            { data: 'colegasAtivos', className: 'text-center background-tabelas-graficos' },
            { data: 'totalDeCovid', className: 'text-center' },
            { data: 'coNull', className: 'text-center' },
            { data: 'coS', className: 'text-center' },
            { data: 'coMais', className: 'text-center' },
            { data: 'co', className: 'text-center' },
            { data: 'qtdAtestadosNaoCotatados', className: 'text-center' },
            { data: 'qtdDiasPerdidosMes', className: 'text-center' },
            { data: 'porcentagemDeAtestadosPorColegas', className: 'text-center background-tabelas-graficos' },
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
