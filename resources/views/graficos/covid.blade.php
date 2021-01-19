@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">

        <div class="col-sm-12 m-t-40 p-0">
            <div id="totalCasosCovidCharts" style="height: 300px;"></div>
        </div>
        <div class="col-sm-12 m-t-40 p-0">
            <div id="qtdDiasPerdidosMesCharts" style="height: 300px;"></div>
        </div>

        <div class="col-sm-12 row p-0">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Unidade</th>
                            <th class="text-center font-12 p-3 background-tabelas-graficos tabelas-graficos-thead">Total de colegas ativos mês</th>
                            <th class="text-center font-12 p-3">Total casos COVID</th>
                            <th class="text-center font-12 p-3">CO</th>
                            <th class="text-center font-12 p-3">CO-S</th>
                            <th class="text-center font-12 p-3">CO+</th>
                            <th class="text-center font-12 p-3">CO-</th>
                            <th class="text-center font-12 p-3">Quantidade atestados não contatados</th>
                            <th class="text-center font-12 p-3">Quantidade dias perdidos mês</th>
                            <th class="text-center font-12 p-3 background-tabelas-graficos tabelas-graficos-thead">% de atestados por Colegas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="col-lg-3 col-md-2 col-sm-6 m-t-40 p-0">
            <div class="col-sm-12 m-t-40 p-0 b-b-1">
                <div id="totalQtdDiasPie" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="asldkjlkgjakjsda"> </div>
            <hr class="b-b-1">
            <div class="col-sm-12 m-t-40 p-0">
                <div id="topCincoQtdAtestadosPie" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col-sm-12 row b-b-1">
                <div class="table-responsive">
                    <table id="topCincoQtdAtestados" class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="text-center font-12 p-3">Top 5 unidades com maior quantidade de atestados</th>
                                <th class="text-center font-12 p-3">Qtdade atestados período</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 m-t-40 p-0">
                <div id="topCincoQtdDiasPerdidosPie" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col-sm-12 row">
                <div class="table-responsive">
                    <table id="topCincoQtdDiasPerdidos" class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="text-center font-12 p-3">Top 5 unidades com maior quantidade de dias perdidos</th>
                                <th class="text-center font-12 p-3">Qtdade dias perdidos período</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-sm-12 m-t-40 p-0">
            <div id="qtdAtestadosPorHospPie" style="height: 1000px;"></div>
        </div>
        <div class="col-sm-12 row"></div> --}}


    </div>
</div>
@endsection

@section('script')
<!-- Tabelas -->
    <script type="text/javascript" src="../js/graficos/covid.js"></script>
<!-- /Tabelas -->

<!-- Graficos Pie -->
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/atestadosPie.js"></script> --}}
<!-- /Graficos Pie -->

<!-- Graficos Column -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/covidCharts.js"></script>
<!-- /Graficos Column -->
@endsection
