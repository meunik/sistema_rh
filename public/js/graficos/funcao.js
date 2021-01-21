
$(document).ready( function () {
    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/funcao/getdata` },
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
});
