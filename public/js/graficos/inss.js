
$(document).ready( function () {
    const table = $('#resultado').DataTable({
        ajax: { "url": `/graficos/inss/getdata` },
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
});
