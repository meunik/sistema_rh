@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">

        <div class="col-sm-12 p-0">
            <div class="col-sm-12 p-0 b-b-1">
                <div id="totalQtdDiasPie" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="col-sm-12 p-0 b-b-1">
                <div class="col-sm-5 p-0">
                    <div id="topCincoQtdAtestadosPie" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-sm-7 row">
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
            </div>
            <div class="col-sm-12 p-0 b-b-1">
                <div class="col-sm-5 p-0">
                    <div id="topCincoQtdDiasPerdidosPie" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-sm-7 row">
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
            </div>
        </div>

        <div class="col-sm-12 m-t-20 p-0">
            <p><b class="text-danger">OBS:</b> Clique ou passe o mouse nas barras dos gráficos para mais detalhes.</p>
        </div>
        <div class="col-sm-12 p-0">
            <div id="qtdAtestadosPorHospCharts" style="height: 400px;"></div>
        </div>
        <div class="col-sm-12 m-t-20 m-b-40 p-0">
            <div id="qtdDiasPerdidosPorHospCharts" style="height: 400px;"></div>
        </div>

        <div class="col-sm-12 row p-0">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Unidade</th>
                            <th class="text-center font-12 p-3 background-tabelas-graficos tabelas-graficos-thead">Total de colegas ativos mês</th>
                            <th class="text-center font-12 p-3">Total de Atestados</th>
                            <th class="text-center font-12 p-3">Atestado por Acidente Trabalho ou Doença</th>
                            <th class="text-center font-12 p-3">Atestado outros motivos</th>
                            <th class="text-center font-12 p-3">Quantidade atestados não contatados</th>
                            <th class="text-center font-12 p-3">Quantidade atestados com contato período</th>
                            <th class="text-center font-12 p-3">Atestados 1 ou 2 dias</th>
                            <th class="text-center font-12 p-3">Atestados de 3 a 15 dias</th>
                            <th class="text-center font-12 p-3">Atestados acima de 15 dias</th>
                            <th class="text-center font-12 p-3">Quantidade dias perdidos mês</th>
                            <th class="text-center font-12 p-3 background-tabelas-graficos tabelas-graficos-thead">% de atestados por Colegas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="col-sm-6 m-t-40 p-0 b-b-1">
            <div id="qtdAtestadosPorHospPie" style="height: 1000px;"></div>
        </div>
        <div class="col-sm-6 m-t-40 p-0 b-b-1">
            <div id="qtdDiasPerdidosPorHospPie" style="height: 1000px;"></div>
        </div> --}}

    </div>
</div>
@endsection

@section('script')
<!-- Tabelas -->
    <script type="text/javascript" src="../js/graficos/atestados.js"></script>
<!-- /Tabelas -->

<!-- Graficos Pie -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/atestadosPie.js"></script>
<!-- /Graficos Pie -->

<!-- Graficos Column -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/atestadosCharts.js"></script>
<!-- /Graficos Column -->
@endsection
