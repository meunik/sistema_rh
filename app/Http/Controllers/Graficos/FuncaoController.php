<?php

namespace App\Http\Controllers\Graficos;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\Graficos\FuncaoService;
use App\Services\{UserService, FiltroService};

class FuncaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('graficos.funcao');
    }

    public function base(Request $request)
    {
        $esteMes = FiltroService::filtroDatas($request);
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = FuncaoService::colagasComAtestados($esteMes, $hospitais);
		return $data;
    }

    public function returnDataTables(Request $request)
    {
        $data = $this->base($request);

        $totalDeAtestados = FuncaoService::totalDeAtestados($data);
        $atestadosPorAcidenteOuDoenca = FuncaoService::atestadosPorAcidenteOuDoenca($data);
        $qtdAtestadosNaoCotatados = FuncaoService::qtdAtestadosNaoCotatados($data);
        $qtdAtestadosComContatoPeriodo = FuncaoService::qtdAtestadosComContatoPeriodo($data);
        $qtdDiasPerdidosMes = FuncaoService::qtdDiasPerdidosMes($data);

        foreach ($data as $dt) {
            $resultados[$dt->funcao] = [
                "funcao" => $dt->funcao,
                "totalDeAtestados" => $totalDeAtestados[$dt->funcao],
                "atestadosPorAcidenteOuDoenca" => $atestadosPorAcidenteOuDoenca[$dt->funcao],
                "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados[$dt->funcao],
                "qtdAtestadosComContatoPeriodo" => $qtdAtestadosComContatoPeriodo[$dt->funcao],
                "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->funcao],
            ];
        }
        $resultados['total'] = [
            "funcao" => 'TOTAL',
            "totalDeAtestados" => $totalDeAtestados['total'],
            "atestadosPorAcidenteOuDoenca" => $atestadosPorAcidenteOuDoenca['total'],
            "qtdAtestadosNaoCotatados" => $qtdAtestadosNaoCotatados['total'],
            "qtdAtestadosComContatoPeriodo" => $qtdAtestadosComContatoPeriodo['total'],
            "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes['total'],
        ];

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quatidade de atestados por função"
     */
    public function totalAtestados(Request $request)
    {
        $data = $this->base($request);
        $totalDeAtestados = FuncaoService::totalDeAtestados($data);

        $retorno[] = ['', 'Atestados'];
        foreach ($data as $dt) {
            $retorno[$dt->funcao] = [
                $dt->funcao,
                $totalDeAtestados[$dt->funcao]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quantidade de dias perdidos por função"
     */
    public function qtdDiasPerdidosMes(Request $request)
    {
        $data = $this->base($request);
        $qtdDiasPerdidosMes = FuncaoService::qtdDiasPerdidosMes($data);

        $retorno[] = ['', 'Atestados'];
        foreach ($data as $dt) {
            $retorno[$dt->funcao] = [
                $dt->funcao,
                $qtdDiasPerdidosMes[$dt->funcao]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }
}
