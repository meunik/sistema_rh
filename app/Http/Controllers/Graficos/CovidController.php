<?php

namespace App\Http\Controllers\Graficos;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\{UserService, FiltroService};
use App\Services\Graficos\{ColegasAtivos, CovidService};

class CovidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('graficos.covid');
    }

    public function base(Request $request)
    {
        $esteMes = FiltroService::filtroDatas($request);
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = CovidService::colagasComCovid($esteMes, $hospitais);
		return $data;
    }

    public function returnDataTables(Request $request)
    {
        $data = $this->base($request);

        $colegasAtivos = ColegasAtivos::qtd();
        $totalDeCovid = CovidService::totalDeCovid($data);
        $co_Null = CovidService::co_Null($data);
        $co_s = CovidService::co_s($data);
        $coMais = CovidService::coMais($data);
        $co = CovidService::co($data);
        $qtdAtestadosNaoCotatados = CovidService::qtdAtestadosNaoCotatados($data);
        $qtdDiasPerdidosMes = CovidService::qtdDiasPerdidosMes($data);
        $porcentagemDeAtestadosPorColegas = CovidService::porcentagemDeAtestadosPorColegas($data, $colegasAtivos, $totalDeCovid);

        foreach ($data as $dt) {
            $resultados[$dt->hospital_id] = [
                "hospital_nome" => $dt->hospital_nome,
                "colegasAtivos" => $colegasAtivos[$dt->hospital_id],
                "totalDeCovid" => $totalDeCovid[$dt->hospital_id],
                "coNull" => $co_Null[$dt->hospital_id],
                "coS" => $co_s[$dt->hospital_id],
                "coMais" => $coMais[$dt->hospital_id],
                "co" => $co[$dt->hospital_id],
                "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados[$dt->hospital_id],
                "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->hospital_id],
                "porcentagemDeAtestadosPorColegas" => $porcentagemDeAtestadosPorColegas[$dt->hospital_id]
            ];
        }
        $resultados['total'] = [
            "hospital_nome" => 'TOTAL',
            "colegasAtivos" => $colegasAtivos['total'],
            "totalDeCovid" => $totalDeCovid['total'],
            "coNull" => $co_Null['total'],
            "coS" => $co_s['total'],
            "coMais" => $coMais['total'],
            "co" => $co['total'],
            "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados['total'],
            "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes['total'],
            "porcentagemDeAtestadosPorColegas" => $porcentagemDeAtestadosPorColegas['total']
        ];

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Total casos COVID por unidade"
     */
    public function totalCasosCovid(Request $request)
    {
        $data = $this->base($request);
        $totalDeCovid = CovidService::totalDeCovid($data);

        $retorno[] = ['', 'Casos de COVID'];
        foreach ($data as $dt) {
            $retorno[$dt->hospital_id] = [
                $dt->hospital_nome,
                $totalDeCovid[$dt->hospital_id]
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
    public function qtdDiasPerdidosMes(Request $request)
    {
        $data = $this->base($request);
        $qtdDiasPerdidosMes = CovidService::qtdDiasPerdidosMes($data);

        $retorno[] = ['', 'Casos de COVID'];
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
}
