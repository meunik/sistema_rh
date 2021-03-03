
function tabela(inicial, final) {
    $('#cidTabela').removeClass('d-none');

    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/cid/getdata?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        ordering:  false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'cid', className: 'text-left' },
            { data: 'grupoCidResumido', className: 'text-center' },
            { data: 'totalDeAtestados', className: 'text-center' },
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
