@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <h3 class="box-title m-b-0">INSS</h3>
        {{-- <p class="m-b-0">Dados referentes aos últimos 30 dias</p> --}}
        <hr class="m-t-5">

        <div class="col-sm-12 row p-0">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Unidade</th>
                            <th class="text-center font-12 p-3">Total Afastados pelo INSS</th>
                            <th class="text-center font-12 p-3">Afastados pelo INSS nos últimos 30 dias</th>
                            <th class="text-center font-12 p-3">Colegas q retornaram de afastamento do INSS no período</th>
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
    <script type="text/javascript" src="../js/graficos/inss.js"></script>
<!-- /Tabelas -->
@endsection
