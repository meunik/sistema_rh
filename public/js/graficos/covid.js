
$(document).ready( function () {
    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/covid/getdata` },
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
            { data: 'coMenos', className: 'text-center' },
            { data: 'qtdAtestadosNaoCotatados', className: 'text-center' },
            { data: 'qtdDiasPerdidosMes', className: 'text-center' },
            { data: 'porcentagemDeAtestadosPorColegas', className: 'text-center background-tabelas-graficos' },
        ],
    });

    // const topCincoQtdAtestados = $('#topCincoQtdAtestados').DataTable({
    //     ajax: { "url": `/graficos/atestados/topCincoQtdAtestados` },
    //     language: { "url": "/Portuguese-Brasil.json" },
    //     paging: false,
    //     info: false,
    //     searching: false,
    //     ordering:  false,
    //     columns: [
    //         { data: 'hospital_nome', className: 'text-center' },
    //         { data: 'totalDeAtestados', className: 'text-center' },
    //     ],
    // });

    // const topCincoQtdDiasPerdidos = $('#topCincoQtdDiasPerdidos').DataTable({
    //     ajax: { "url": `/graficos/atestados/topCincoQtdDiasPerdidos` },
    //     language: { "url": "/Portuguese-Brasil.json" },
    //     paging: false,
    //     info: false,
    //     searching: false,
    //     ordering:  false,
    //     columns: [
    //         { data: 'hospital_nome', className: 'text-center' },
    //         { data: 'qtdDiasPerdidosMes', className: 'text-center' },
    //     ],
    // });
});
