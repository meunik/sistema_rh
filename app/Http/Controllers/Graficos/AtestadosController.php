<?php

namespace App\Http\Controllers\Graficos;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\{UserService, FiltroService};
use App\Services\Graficos\{ColegasAtivos, AtestadosService};

class AtestadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('graficos.atestados');
    }

    public function base(Request $request)
    {
        $esteMes = FiltroService::filtroDatas($request);
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = AtestadosService::colagasComAtestados($esteMes, $hospitais);
		return $data;
    }

    public function returnDataTables(Request $request)
    {
        $data = $this->base($request);

        $colegasAtivos = ColegasAtivos::qtd();
        $totalDeAtestados = AtestadosService::totalDeAtestados($data);
        $atestadosPorAcidenteOuDoenca = AtestadosService::atestadosPorAcidenteOuDoenca($data);
        $atestadosPorOutrosMotivos = AtestadosService::atestadosPorOutrosMotivos($data);
        $qtdAtestadosNaoCotatados = AtestadosService::qtdAtestadosNaoCotatados($data);
        $qtdAtestadosComContatoPeriodo = AtestadosService::qtdAtestadosComContatoPeriodo($data);
        $atestados1Ou2Dias = AtestadosService::atestados1Ou2Dias($data);
        $atestados3A15Dias = AtestadosService::atestados3A15Dias($data);
        $atestadosAcimaDe15Dias = AtestadosService::atestadosAcimaDe15Dias($data);
        $qtdDiasPerdidosMes = AtestadosService::qtdDiasPerdidosMes($data);
        $porcentagemDeAtestadosPorColegas = AtestadosService::porcentagemDeAtestadosPorColegas($data, $colegasAtivos, $totalDeAtestados);

        foreach ($data as $dt) {
            $resultados[$dt->hospital_id] = [
                "hospital_nome" => $dt->hospital_nome,
                "colegasAtivos" => $colegasAtivos[$dt->hospital_id],
                "totalDeAtestados" => $totalDeAtestados[$dt->hospital_id],
                "atestadosPorAcidenteOuDoenca" => $atestadosPorAcidenteOuDoenca[$dt->hospital_id],
                "atestadosPorOutrosMotivos" => $atestadosPorOutrosMotivos[$dt->hospital_id],
                "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados[$dt->hospital_id],
                "qtdAtestadosComContatoPeriodo" => $qtdAtestadosComContatoPeriodo[$dt->hospital_id],
                "atestados1Ou2Dias" => $atestados1Ou2Dias[$dt->hospital_id],
                "atestados3A15Dias" => $atestados3A15Dias[$dt->hospital_id],
                "atestadosAcimaDe15Dias" => $atestadosAcimaDe15Dias[$dt->hospital_id],
                "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->hospital_id],
                "porcentagemDeAtestadosPorColegas" => $porcentagemDeAtestadosPorColegas[$dt->hospital_id]
            ];
        }
        $resultados['total'] = [
            "hospital_nome" => 'TOTAL',
            "colegasAtivos" => $colegasAtivos['total'],
            "totalDeAtestados" => $totalDeAtestados['total'],
            "atestadosPorAcidenteOuDoenca" => $atestadosPorAcidenteOuDoenca['total'],
            "atestadosPorOutrosMotivos" => $atestadosPorOutrosMotivos['total'],
            "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados['total'],
            "qtdAtestadosComContatoPeriodo" => $qtdAtestadosComContatoPeriodo['total'],
            "atestados1Ou2Dias" => $atestados1Ou2Dias['total'],
            "atestados3A15Dias" => $atestados3A15Dias['total'],
            "atestadosAcimaDe15Dias" => $atestadosAcimaDe15Dias['total'],
            "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes['total'],
            "porcentagemDeAtestadosPorColegas" => $porcentagemDeAtestadosPorColegas['total']
        ];

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Distribuição atestados"
     *  Um array com somente os totais de quantidades de dias.
     */
    public function totalQtdDias(Request $request)
    {
        $data = $this->base($request);

        $atestados1Ou2Dias = AtestadosService::atestados1Ou2Dias($data);
        $atestados3A15Dias = AtestadosService::atestados3A15Dias($data);
        $atestadosAcimaDe15Dias = AtestadosService::atestadosAcimaDe15Dias($data);
        $resultados = [
            "atestados1Ou2Dias" => $atestados1Ou2Dias['total'],
            "atestados3A15Dias" => $atestados3A15Dias['total'],
            "atestadosAcimaDe15Dias" => $atestadosAcimaDe15Dias['total'],
        ];

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quantidade de atestados por unidade"
     */
    public function qtdAtestadosPorHosp(Request $request)
    {
        $data = $this->base($request);

        $totalDeAtestados = AtestadosService::totalDeAtestados($data);

        $retorno[] = ['', 'Atestados'];
        foreach ($data as $dt) {
            $retorno[$dt->hospital_id] = [
                $dt->hospital_nome,
                $totalDeAtestados[$dt->hospital_id]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quantidade de dias perdidos por unidade"
     */
    public function qtdDiasPerdidosPorHosp(Request $request)
    {
        $data = $this->base($request);

        $qtdDiasPerdidosMes = AtestadosService::qtdDiasPerdidosMes($data);

        $retorno[] = ['', 'Dias'];
        foreach ($data as $dt) {
            $retorno[$dt->hospital_id] = [
                $dt->hospital_nome,
                $qtdDiasPerdidosMes[$dt->hospital_id]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Top 5 unidades com maior quantidade de atestados"
     */
    public function topCincoQtdAtestados(Request $request)
    {
        $data = $this->base($request);

        $totalDeAtestados = AtestadosService::totalDeAtestados($data);
        foreach ($data as $dt) {
            $resultados[$dt->hospital_id] = [
                "totalDeAtestados" => $totalDeAtestados[$dt->hospital_id],
                "hospital_nome" => $dt->hospital_nome
            ];
        }

        $return = [];
        $returnNull = [
            "totalDeAtestados" => 0,
            "hospital_nome" => 'Nenhum dado encontrado'
        ];

        if (isset($resultados)) rsort($resultados);

        for ($i=0; $i < 5; $i++) {
            $i2 = $i+1;
            $return["posicao$i2"] = isset($resultados[$i]) ? $resultados[$i] : $returnNull;
        }

		return DataTables::of($return)->make(true);
    }

    /**
     *  "Top 5 unidades com maior quantidade de dias perdidos"
     */
    public function topCincoQtdDiasPerdidos(Request $request)
    {
        $data = $this->base($request);

        $qtdDiasPerdidosMes = AtestadosService::qtdDiasPerdidosMes($data);
        foreach ($data as $dt) {
            $resultados[$dt->hospital_id] = [
                "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->hospital_id],
                "hospital_nome" => $dt->hospital_nome
            ];
        }

        $return = [];
        $returnNull = [
            "qtdDiasPerdidosMes" => 0,
            "hospital_nome" => 'Nenhum dado encontrado'
        ];

        if (isset($resultados)) rsort($resultados);

        for ($i=0; $i < 5; $i++) {
            $i2 = $i+1;
            $return["posicao$i2"] = isset($resultados[$i]) ? $resultados[$i] : $returnNull;
        }

		return DataTables::of($return)->make(true);
    }
}
