
function tabela(inicial, final) {
    $('#inssTabela').removeClass('d-none');

    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/inss/getdata?inicial=${inicial}&final=${final}` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        ordering:  false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'hospital_nome', className: 'text-left' },
            { data: 'totalDeAfastados', className: 'text-center' },
            { data: 'totalDeAfastadosPeriodo', className: 'text-center' },
            { data: 'colegasRetornaramPeriodo', className: 'text-center' },
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

    if(inicial && final) tabela(inicial, final);
});
