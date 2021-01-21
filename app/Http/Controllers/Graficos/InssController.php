<?php

namespace App\Http\Controllers\Graficos;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\Graficos\InssService;
use App\Services\{UserService, FiltroService};

class InssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = $this->base();

        // $totalDeAtestados = InssService::totalDeAtestados($data);
        // $qtdDiasPerdidosMes = InssService::qtdDiasPerdidosMes($data);

        // foreach ($data as $dt) {
        //     $cidCompleto = $dt->cid_categoria.' - '.$dt->cid_nome;

        //     $resultados[$dt->cid_id] = [
        //         "cid" => $cidCompleto,
        //         "grupoCidResumido" => $dt->cid_categoria,
        //         "totalDeAtestados" => $totalDeAtestados[$dt->cid_id],
        //         "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes[$dt->cid_id],
        //     ];
        // }
        // $resultados['total'] = [
        //     "cid" => 'TOTAL',
        //     "grupoCidResumido" => '',
        //     "totalDeAtestados" => $totalDeAtestados['total'],
        //     "qtdDiasPerdidosMes" => $qtdDiasPerdidosMes['total'],
        // ];

        // echo json_encode($data);
        exit;

        return view('graficos.inss');
    }

    public function base()
    {
        $esteMes = FiltroService::esteMes();
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = InssService::colagasComAtestados($esteMes, $hospitais);
		return $data;
    }

    public function returnDataTables()
    {
        $data = $this->base();

        $totalDeAtestados = InssService::totalDeAtestados($data);
        $qtdDiasPerdidosMes = InssService::qtdDiasPerdidosMes($data);

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
        $totalDeAtestados = InssService::totalDeAtestados($data);

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
        $qtdDiasPerdidosMes = InssService::qtdDiasPerdidosMes($data);

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
