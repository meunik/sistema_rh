
$(document).ready( function () {
    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/atestados/getdata` },
        language: { "url": "/Portuguese-Brasil.json" },
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columns: [
            { data: 'hospital_nome', className: 'text-center' },
            { data: 'colegasAtivos', className: 'text-center background-yellow' },
            { data: 'totalDeAtestados', className: 'text-center' },
            { data: 'atestadosPorAcidenteOuDoenca', className: 'text-center' },
            { data: 'atestadosPorOutrosMotivos', className: 'text-center' },
            { data: 'qtdAtestadosNaoCotatados', className: 'text-center' },
            { data: 'qtdAtestadosComContatoPeriodo', className: 'text-center' },
            { data: 'atestados1Ou2Dias', className: 'text-center' },
            { data: 'atestados3A15Dias', className: 'text-center' },
            { data: 'atestadosAcimaDe15Dias', className: 'text-center' },
            { data: 'qtdDiasPerdidosMes', className: 'text-center' },
            { data: 'porcentagemDeAtestadosPorColegas', className: 'text-center background-yellow' },
        ],
    });

    const topCincoQtdAtestados = $('#topCincoQtdAtestados').DataTable({
        ajax: { "url": `/graficos/atestados/topCincoQtdAtestados` },
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
        ajax: { "url": `/graficos/atestados/topCincoQtdDiasPerdidos` },
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
});
