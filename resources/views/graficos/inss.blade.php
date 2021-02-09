@extends('layout')

@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="white-box">
        <h3 class="box-title m-b-0">INSS</h3>
        @include('graficos.filtro')
        <hr class="m-t-5">

        <div id="inssTabela" class="col-sm-12 row p-0 d-none">
            <div class="col-sm-12 table-responsive p-0 p-r-10">
                <table id="resultado" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center font-12 p-3">Unidade</th>
                            <th class="text-center font-12 p-3">Total Afastados pelo INSS</th>
                            <th class="text-center font-12 p-3">Afastados pelo INSS no período</th>
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
<script src="{{URL::asset('js/getUrlParameter.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/newUrl.js')}}" type="text/javascript"></script>
<!-- Tabelas -->
    <script type="text/javascript" src="../js/graficos/inss.js"></script>
<!-- /Tabelas -->
@endsection
