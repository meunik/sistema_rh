<?php

namespace App\Http\Controllers\Graficos;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\Graficos\CidService;
use App\Services\{UserService, FiltroService};

class CidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('graficos.cid');
    }

    public function base()
    {
        $esteMes = FiltroService::esteMes();
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = CidService::colagasComAtestados($esteMes, $hospitais);
		return $data;
    }

    public function returnDataTables()
    {
        $data = $this->base();

        $totalDeAtestados = CidService::totalDeAtestados($data);
        $qtdDiasPerdidosMes = CidService::qtdDiasPerdidosMes($data);

        foreach ($data as $dt) {
            $cidCompleto = $dt->cid_categoria.' - '.$dt->cid_nome;

            $resultados[$dt->cid_id] = [
                "cid" => $cidCompleto,
                "grupoCidResumido" => $dt->cid_categoria,
                "totalDeAtestados" => $totalDeAtestados[$dt->cid_id],
                "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->cid_id],
            ];
        }
        $resultados['total'] = [
            "cid" => 'TOTAL',
            "grupoCidResumido" => '',
            "totalDeAtestados" => $totalDeAtestados['total'],
            "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes['total'],
        ];

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quatidade de atestados por grupo CID"
     */
    public function totalAtestados()
    {
        $data = $this->base();
        $totalDeAtestados = CidService::totalDeAtestados($data);

        $retorno[] = ['', 'Atestados'];
        foreach ($data as $dt) {
            $retorno[$dt->cid_id] = [
                $dt->cid_categoria,
                $totalDeAtestados[$dt->cid_id]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }

    /**
     *  "Quantidade de dias perdidos por grupo CID"
     */
    public function qtdDiasPerdidosMes()
    {
        $data = $this->base();
        $qtdDiasPerdidosMes = CidService::qtdDiasPerdidosMes($data);

        $retorno[] = ['', 'Atestados'];
        foreach ($data as $dt) {
            $retorno[$dt->cid_id] = [
                $dt->cid_categoria,
                $qtdDiasPerdidosMes[$dt->cid_id]
            ];
        }

        foreach ($retorno as $result) {
            $resultados[] = $result;
        }

		return DataTables::of($resultados)->make(true);
    }
}
