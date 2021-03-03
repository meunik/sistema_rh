
function tabela(inicial, final) {
    $('#funcaoTabela').removeClass('d-none');

    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/funcao/getdata?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        ordering:  false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'funcao', className: 'text-left' },
            { data: 'totalDeAtestados', className: 'text-center' },
            { data: 'atestadosPorAcidenteOuDoenca', className: 'text-center' },
            { data: 'qtdAtestadosNaoCotatados', className: 'text-center' },
            { data: 'qtdAtestadosComContatoPeriodo', className: 'text-center' },
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
