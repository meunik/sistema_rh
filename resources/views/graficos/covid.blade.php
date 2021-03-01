@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <h3 class="box-title m-b-0">COVID</h3>
        <p class="m-b-0">Dados referentes aos últimos 30 dias</p>
        <hr class="m-t-5">

        <b class="text-danger">OBS:</b>
        <li>Clique ou passe o mouse nas barras dos gráficos para mais detalhes(nome e valor).</li>
        <li>Os gáficos seguem a mesma ordem da tabela no final da página</li>
        <br>

        <div class="col-sm-12 m-t-40 p-0">
            <div id="totalCasosCovidCharts" style="height: 300px;"></div>
        </div>
        <div class="col-sm-12 m-t-20 m-b-40 p-0">
            <div id="qtdDiasPerdidosMesCharts" style="height: 300px;"></div>
        </div>

        {{-- <div class="col-sm-6 m-t-40 m-b-40 p-0">
            <div id="totalCasosCovidPie" style="height: 500px;"></div>
        </div>
        <div class="col-sm-6 m-b-40 p-0">
            <div id="qtdDiasPerdidosMesPie" style="height: 500px;"></div>
        </div> --}}

        <div class="col-sm-12 row p-0">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Unidade</th>
                            <th class="text-center font-12 p-3 background-tabelas-graficos tabelas-graficos-thead">Total de colegas ativos mês</th>
                            <th class="text-center font-12 p-3">Total casos COVID</th>
                            <th class="text-center font-12 p-3">Indefinidos</th>
                            <th class="text-center font-12 p-3">CO-S</th>
                            <th class="text-center font-12 p-3">CO+</th>
                            <th class="text-center font-12 p-3">CO</th>
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

    </div>
</div>
@endsection

@section('script')
<!-- Tabelas -->
    <script type="text/javascript" src="../js/graficos/covid.js"></script>
<!-- /Tabelas -->

<!-- Graficos Pie -->
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/covidPie.js"></script> --}}
<!-- /Graficos Pie -->

<!-- Graficos Column -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/covidCharts.js"></script>
<!-- /Graficos Column -->
@endsection
