@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <h3 class="box-title m-b-0">CID</h3>
        <p class="m-b-0">Dados referentes aos últimos 30 dias</p>
        <hr class="m-t-5">

        <b class="text-danger">OBS:</b>
        <li>Clique ou passe o mouse nas barras dos gráficos para mais detalhes(nome e valor).</li>
        <li>Os gáficos seguem a mesma ordem da tabela no final da página</li>
        <br>

        <div class="col-sm-12 p-0">
            <div id="totalAtestadosCharts" style="height: 300px;"></div>
        </div>
        <div class="col-sm-12 m-t-20 m-b-40 p-0">
            <div id="qtdDiasPerdidosMesCharts" style="height: 300px;"></div>
        </div>

        {{-- <div class="col-sm-6 m-b-40 p-0">
            <div id="totalAtestadosPie" style="height: 500px;"></div>
        </div>
        <div class="col-sm-6 m-b-40 p-0">
            <div id="qtdDiasPerdidosMesPie" style="height: 500px;"></div>
        </div> --}}

        <div class="col-sm-12 row p-0">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Grupo CID</th>
                            <th class="text-center font-12 p-3">Grupo CID resumido</th>
                            <th class="text-center font-12 p-3">Total de Atestados</th>
                            <th class="text-center font-12 p-3">Quantidade dias perdidos mês</th>
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
    <script type="text/javascript" src="../js/graficos/cid.js"></script>
<!-- /Tabelas -->

<!-- Graficos Pie -->
    {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/cidPie.js"></script> --}}
<!-- /Graficos Pie -->

<!-- Graficos Column -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../js/graficos/cidCharts.js"></script>
<!-- /Graficos Column -->
@endsection
